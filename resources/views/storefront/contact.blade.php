@extends('storefront.layout')

@section('content')
<div class="mx-auto max-w-7xl px-4 py-12 sm:px-6 lg:px-8">
    <div class="mb-8">
        <p class="text-sm font-semibold uppercase tracking-[0.2em] text-emerald-700">Get in touch</p>
        <h1 class="mt-2 text-4xl font-black tracking-tight text-slate-900">Contact us</h1>
        <p class="mt-3 max-w-xl text-slate-600">Questions about an order, a product, or anything else — send us a message and we'll reply as soon as we can.</p>
    </div>

    <div class="grid gap-8 lg:grid-cols-[1fr_0.7fr]">
        <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
            @if(session('success'))
                <div class="mb-6 rounded-xl border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm font-medium text-emerald-700">
                    {{ session('success') }}
                </div>
            @endif

            <form method="POST" action="{{ route('contact.store') }}" class="space-y-5">
                @csrf
                <div class="grid gap-5 sm:grid-cols-2">
                    <div>
                        <label class="mb-2 block text-sm font-medium text-slate-700">Your name</label>
                        <input type="text" name="name" value="{{ old('name') }}" class="w-full rounded-xl border border-slate-200 px-4 py-3 focus:border-emerald-500 focus:outline-none" required>
                        @error('name')<p class="mt-1 text-xs text-red-600">{{ $message }}</p>@enderror
                    </div>
                    <div>
                        <label class="mb-2 block text-sm font-medium text-slate-700">Email address</label>
                        <input type="email" name="email" value="{{ old('email') }}" class="w-full rounded-xl border border-slate-200 px-4 py-3 focus:border-emerald-500 focus:outline-none" required>
                        @error('email')<p class="mt-1 text-xs text-red-600">{{ $message }}</p>@enderror
                    </div>
                </div>
                <div>
                    <label class="mb-2 block text-sm font-medium text-slate-700">Subject</label>
                    <input type="text" name="topic" value="{{ old('topic') }}" class="w-full rounded-xl border border-slate-200 px-4 py-3 focus:border-emerald-500 focus:outline-none" required>
                    @error('topic')<p class="mt-1 text-xs text-red-600">{{ $message }}</p>@enderror
                </div>
                <div>
                    <label class="mb-2 block text-sm font-medium text-slate-700">Message</label>
                    <textarea name="message" rows="6" class="w-full rounded-xl border border-slate-200 px-4 py-3 focus:border-emerald-500 focus:outline-none" required>{{ old('message') }}</textarea>
                    @error('message')<p class="mt-1 text-xs text-red-600">{{ $message }}</p>@enderror
                </div>
                <button type="submit" class="rounded-full bg-emerald-600 px-6 py-3 text-sm font-semibold text-white hover:bg-emerald-500">Send message</button>
            </form>
        </div>

        <aside class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
            <h2 class="text-lg font-bold text-slate-900">Contact details</h2>
            <ul class="mt-4 space-y-3 text-sm text-slate-600">
                <li>{{ $settings['phone'] ?? '+44 20 5555 0142' }}</li>
                <li>{{ $settings['email'] ?? 'hello@propharmat.com' }}</li>
                <li>{{ $settings['address'] ?? '45 Regent Street, London, UK' }}</li>
            </ul>
        </aside>
    </div>
</div>
@endsection
