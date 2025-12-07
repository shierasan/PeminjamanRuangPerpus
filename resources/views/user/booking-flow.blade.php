@extends('layouts.user')

@section('title', 'Alur Peminjaman')

@section('content')
    <div class="container" style="max-width: 900px; margin: 0 auto; padding: 1.5rem 1rem;">
        <div style="background: white; border-radius: 12px; padding: 3rem 2.5rem; box-shadow: 0 2px 8px rgba(0,0,0,0.1);">
            {{-- Header --}}
            <div style="margin-bottom: 3rem;">
                <h1 style="font-size: 2.5rem; font-weight: 700; color: #1a1a1a; margin-bottom: 0.5rem;">
                    Informasi
                </h1>
                <div style="text-align: center; margin-top: 2rem;">
                    <h2 style="font-size: 1.5rem; font-weight: 600; color: #B8985F; margin-bottom: 0.5rem;">
                        Alur Peminjaman
                    </h2>
                    <p style="color: #666; font-size: 0.95rem;">
                        Panduan langkah demi langkah untuk melakukan peminjaman ruangan Universitas Andalas
                    </p>
                </div>
            </div>

            {{-- Steps --}}
            @forelse($steps as $step)
                <div
                    style="background: #FFF9E6; border: 1px solid #E6D5A8; border-radius: 12px; padding: 1.5rem; margin-bottom: 1.5rem;">
                    <div style="display: flex; gap: 1rem; align-items: start;">
                        <div
                            style="background: linear-gradient(135deg, #B8985F, #9d7d4b); color: white; width: 32px; height: 32px; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-weight: 700; flex-shrink: 0;">
                            {{ $step->step_number }}
                        </div>
                        <div style="flex: 1;">
                            <h3 style="font-size: 1.1rem; font-weight: 600; color: #B8985F; margin: 0 0 0.5rem 0;">
                                {{ $step->title }}
                            </h3>
                            <p style="color: #666; font-size: 0.95rem; line-height: 1.6; margin: 0;">
                                {{ $step->description }}
                            </p>
                            @if($step->image)
                                <div style="margin-top: 1rem; background: #e5e7eb; border-radius: 8px; overflow: hidden;">
                                    <img src="{{ asset('storage/' . $step->image) }}" alt="{{ $step->title }}"
                                        style="width: 100%; max-width: 400px; height: auto; display: block; margin: 0 auto;">
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            @empty
                <div style="text-align: center; padding: 3rem; color: #666;">
                    <p>Alur peminjaman belum tersedia.</p>
                </div>
            @endforelse
        </div>
    </div>
@endsection