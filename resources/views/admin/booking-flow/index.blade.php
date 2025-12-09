@extends('layouts.app')

@section('title', 'Alur Peminjaman - Admin')

@section('content')
    <div class="container" style="max-width: 900px; margin: 0 auto; padding: 1.5rem 1rem;">
        <div style="background: white; border-radius: 12px; padding: 2.5rem; box-shadow: 0 2px 8px rgba(0,0,0,0.1);">
            {{-- Header --}}
            <div style="margin-bottom: 2rem;">
                <h1 style="font-size: 1.75rem; font-weight: 700; color: #1a1a1a; margin-bottom: 0.25rem;">
                    Alur Peminjaman
                </h1>
                <p style="color: #666; font-size: 0.9rem;">
                    Kelola langkah-langkah alur peminjaman yang ditampilkan kepada pengguna
                </p>
            </div>

            {{-- Success Message --}}
            @if(session('success'))
                <div
                    style="background: #d1fae5; border: 1px solid #34d399; color: #065f46; padding: 1rem; border-radius: 8px; margin-bottom: 1.5rem;">
                    {{ session('success') }}
                </div>
            @endif

            <form action="{{ route('admin.booking-flow.update') }}" method="POST" id="flowForm">
                @csrf
                @method('PUT')

                <div id="stepsContainer">
                    @forelse($steps as $index => $step)
                        <div class="step-item" data-id="{{ $step->id }}"
                            style="background: #FFF9E6; border: 1px solid #E6D5A8; border-radius: 12px; padding: 1.5rem; margin-bottom: 1rem; position: relative;">
                            <div style="display: flex; gap: 1rem; align-items: start;">
                                <div
                                    style="background: linear-gradient(135deg, #B8985F, #9d7d4b); color: white; width: 32px; height: 32px; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-weight: 700; flex-shrink: 0;">
                                    <span class="step-number">{{ $index + 1 }}</span>
                                </div>
                                <div style="flex: 1;">
                                    <input type="hidden" name="steps[{{ $index }}][id]" value="{{ $step->id }}">
                                    <input type="text" name="steps[{{ $index }}][title]" value="{{ $step->title }}"
                                        placeholder="Judul langkah"
                                        style="width: 100%; padding: 0.75rem 1rem; border: 1px solid #ddd; border-radius: 8px; font-size: 1rem; font-weight: 600; margin-bottom: 0.75rem;">
                                    <textarea name="steps[{{ $index }}][description]" placeholder="Deskripsi langkah" rows="2"
                                        style="width: 100%; padding: 0.75rem 1rem; border: 1px solid #ddd; border-radius: 8px; font-size: 0.95rem; resize: vertical;">{{ $step->description }}</textarea>

                                    {{-- Image Upload --}}
                                    <div style="margin-top: 0.75rem;">
                                        @if($step->image)
                                            <div class="image-preview" style="position: relative; display: inline-block;">
                                                <img src="{{ asset('storage/' . $step->image) }}" alt="Step image"
                                                    style="max-width: 200px; height: auto; border-radius: 8px;">
                                                <button type="button" onclick="deleteImage({{ $step->id }}, this)"
                                                    style="position: absolute; top: 0.25rem; right: 0.25rem; background: #ef4444; color: white; border: none; border-radius: 50%; width: 24px; height: 24px; cursor: pointer; font-size: 0.75rem;">×</button>
                                            </div>
                                        @else
                                            <input type="file" accept="image/*" onchange="uploadImage({{ $step->id }}, this)"
                                                style="font-size: 0.875rem; color: #666;">
                                        @endif
                                    </div>
                                </div>
                                <button type="button" onclick="removeStep(this)"
                                    style="background: #fee2e2; color: #dc2626; border: none; padding: 0.5rem 0.75rem; border-radius: 6px; cursor: pointer; font-size: 0.75rem;">
                                    Hapus
                                </button>
                            </div>
                        </div>
                    @empty
                        <p id="emptyMessage" style="text-align: center; color: #666; padding: 2rem;">
                            Belum ada langkah. Klik tombol "Tambah Langkah" untuk memulai.
                        </p>
                    @endforelse
                </div>

                <div style="display: flex; justify-content: space-between; margin-top: 1.5rem;">
                    <button type="button" onclick="addStep()"
                        style="padding: 0.75rem 1.5rem; background: #f0f0f0; color: #333; border: 1px solid #ddd; border-radius: 8px; cursor: pointer; font-weight: 500; display: flex; align-items: center; gap: 0.5rem;">
                        <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                        </svg>
                        Tambah Langkah
                    </button>
                    <button type="submit"
                        style="padding: 0.75rem 2rem; background: linear-gradient(135deg, #B8985F, #9d7d4b); color: white; border: none; border-radius: 8px; font-weight: 600; cursor: pointer;">
                        Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        let stepCount = {{ $steps->count() }};

        function addStep() {
            document.getElementById('emptyMessage')?.remove();
            const container = document.getElementById('stepsContainer');
            const index = container.querySelectorAll('.step-item').length;

            const stepHtml = `
                        <div class="step-item" style="background: #FFF9E6; border: 1px solid #E6D5A8; border-radius: 12px; padding: 1.5rem; margin-bottom: 1rem; position: relative;">
                            <div style="display: flex; gap: 1rem; align-items: start;">
                                <div style="background: linear-gradient(135deg, #B8985F, #9d7d4b); color: white; width: 32px; height: 32px; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-weight: 700; flex-shrink: 0;">
                                    <span class="step-number">${index + 1}</span>
                                </div>
                                <div style="flex: 1;">
                                    <input type="text" name="steps[${index}][title]" placeholder="Judul langkah"
                                        style="width: 100%; padding: 0.75rem 1rem; border: 1px solid #ddd; border-radius: 8px; font-size: 1rem; font-weight: 600; margin-bottom: 0.75rem;">
                                    <textarea name="steps[${index}][description]" placeholder="Deskripsi langkah" rows="2"
                                        style="width: 100%; padding: 0.75rem 1rem; border: 1px solid #ddd; border-radius: 8px; font-size: 0.95rem; resize: vertical;"></textarea>
                                    <p style="font-size: 0.75rem; color: #666; margin-top: 0.5rem;">* Gambar dapat diupload setelah menyimpan</p>
                                </div>
                                <button type="button" onclick="removeStep(this)" style="background: #fee2e2; color: #dc2626; border: none; padding: 0.5rem 0.75rem; border-radius: 6px; cursor: pointer; font-size: 0.75rem;">
                                    Hapus
                                </button>
                            </div>
                        </div>
                    `;

            container.insertAdjacentHTML('beforeend', stepHtml);
            updateStepNumbers();
        }

        async function removeStep(btn) {
            const confirmed = await confirmDelete('langkah ini');
            if (confirmed) {
                btn.closest('.step-item').remove();
                updateStepNumbers();
            }
        }

        function updateStepNumbers() {
            const items = document.querySelectorAll('.step-item');
            items.forEach((item, index) => {
                item.querySelector('.step-number').textContent = index + 1;
                // Update field names
                const inputs = item.querySelectorAll('[name^="steps["]');
                inputs.forEach(input => {
                    input.name = input.name.replace(/steps\[\d+\]/, `steps[${index}]`);
                });
            });
        }

        function uploadImage(stepId, input) {
            const file = input.files[0];
            if (!file) return;

            const formData = new FormData();
            formData.append('image', file);
            formData.append('_token', '{{ csrf_token() }}');

            fetch(`/admin/booking-flow/${stepId}/upload-image`, {
                method: 'POST',
                body: formData
            })
                .then(res => res.json())
                .then(data => {
                    if (data.success) {
                        location.reload();
                    }
                });
        }

        async function deleteImage(stepId, btn) {
            const confirmed = await confirmDelete('gambar ini');
            if (!confirmed) return;

            fetch(`/admin/booking-flow/${stepId}/delete-image`, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            })
                .then(res => res.json())
                .then(data => {
                    if (data.success) {
                        location.reload();
                    }
                });
        }
    </script>
@endsection