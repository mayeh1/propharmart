<x-app-layout>
<div class="py-12">
    <div class="mx-auto max-w-4xl px-4 sm:px-6 lg:px-8">
        <div class="mb-6">
            <p class="text-sm font-semibold uppercase tracking-[0.2em] text-emerald-700">CMS</p>
            <h1 class="mt-2 text-3xl font-black tracking-tight text-slate-900">Website settings</h1>
        </div>

        <form method="POST" action="{{ route('admin.settings.store') }}" class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
            @csrf

            <div class="grid gap-6 md:grid-cols-2">
                <div>
                    <label class="mb-2 block text-sm font-medium text-slate-700">Business name</label>
                    <input type="text" name="site_name" value="{{ old('site_name', $settings['site_name'] ?? 'PROPHAMART') }}" class="w-full rounded-xl border border-slate-200 px-4 py-3 focus:border-emerald-500 focus:outline-none">
                </div>
                <div>
                    <label class="mb-2 block text-sm font-medium text-slate-700">Tagline</label>
                    <input type="text" name="tagline" value="{{ old('tagline', $settings['tagline'] ?? 'Trusted Wellness & Pharmacy Care') }}" class="w-full rounded-xl border border-slate-200 px-4 py-3 focus:border-emerald-500 focus:outline-none">
                </div>
                <div>
                    <label class="mb-2 block text-sm font-medium text-slate-700">Phone</label>
                    <input type="text" name="phone" value="{{ old('phone', $settings['phone'] ?? '+44 20 5555 0142') }}" class="w-full rounded-xl border border-slate-200 px-4 py-3 focus:border-emerald-500 focus:outline-none">
                </div>
                <div>
                    <label class="mb-2 block text-sm font-medium text-slate-700">Email</label>
                    <input type="email" name="email" value="{{ old('email', $settings['email'] ?? 'hello@propharmat.com') }}" class="w-full rounded-xl border border-slate-200 px-4 py-3 focus:border-emerald-500 focus:outline-none">
                </div>
                <div class="md:col-span-2">
                    <label class="mb-2 block text-sm font-medium text-slate-700">Address</label>
                    <input type="text" name="address" value="{{ old('address', $settings['address'] ?? '45 Regent Street, London, UK') }}" class="w-full rounded-xl border border-slate-200 px-4 py-3 focus:border-emerald-500 focus:outline-none">
                </div>
                <div class="md:col-span-2">
                    <label class="mb-2 block text-sm font-medium text-slate-700">Hero title</label>
                    <input type="text" name="hero_title" value="{{ old('hero_title', $settings['hero_title'] ?? 'Better health starts with the right care.') }}" class="w-full rounded-xl border border-slate-200 px-4 py-3 focus:border-emerald-500 focus:outline-none">
                </div>
                <div class="md:col-span-2">
                    <label class="mb-2 block text-sm font-medium text-slate-700">Hero subtitle</label>
                    <textarea name="hero_subtitle" rows="4" class="w-full rounded-xl border border-slate-200 px-4 py-3 focus:border-emerald-500 focus:outline-none">{{ old('hero_subtitle', $settings['hero_subtitle'] ?? 'Discover pharmacy essentials, wellness products, and specialist nutrition tailored for modern lifestyles.') }}</textarea>
                </div>
                <div class="md:col-span-2">
                    <label class="mb-2 block text-sm font-medium text-slate-700">Footer text</label>
                    <textarea name="footer_text" rows="3" class="w-full rounded-xl border border-slate-200 px-4 py-3 focus:border-emerald-500 focus:outline-none">{{ old('footer_text', $settings['footer_text'] ?? 'PROPHAMART delivers trusted health, wellness, and pharmacy essentials worldwide.') }}</textarea>
                </div>
                <div>
                    <label class="mb-2 block text-sm font-medium text-slate-700">Shipping message</label>
                    <input type="text" name="shipping_message" value="{{ old('shipping_message', $settings['shipping_message'] ?? 'Free shipping on all orders over £60') }}" class="w-full rounded-xl border border-slate-200 px-4 py-3 focus:border-emerald-500 focus:outline-none">
                </div>
                <div>
                    <label class="mb-2 block text-sm font-medium text-slate-700">Dispatch message</label>
                    <input type="text" name="dispatch_message" value="{{ old('dispatch_message', $settings['dispatch_message'] ?? 'Fast UK & EU dispatch') }}" class="w-full rounded-xl border border-slate-200 px-4 py-3 focus:border-emerald-500 focus:outline-none">
                </div>
                <div>
                    <label class="mb-2 block text-sm font-medium text-slate-700">Security message</label>
                    <input type="text" name="security_message" value="{{ old('security_message', $settings['security_message'] ?? '100% secure checkout') }}" class="w-full rounded-xl border border-slate-200 px-4 py-3 focus:border-emerald-500 focus:outline-none">
                </div>
                <div>
                    <label class="mb-2 block text-sm font-medium text-slate-700">Welcome message</label>
                    <input type="text" name="welcome_message" value="{{ old('welcome_message', $settings['welcome_message'] ?? 'Welcome to PROPHAMART — your wellness and pharmacy partner.') }}" class="w-full rounded-xl border border-slate-200 px-4 py-3 focus:border-emerald-500 focus:outline-none">
                </div>
                <div class="md:col-span-2">
                    <label class="mb-2 block text-sm font-medium text-slate-700">"Why choose us" heading</label>
                    <input type="text" name="why_choose_title" value="{{ old('why_choose_title', $settings['why_choose_title'] ?? 'Fast, secure and trusted pharmacy care') }}" class="w-full rounded-xl border border-slate-200 px-4 py-3 focus:border-emerald-500 focus:outline-none">
                </div>
                <div class="md:col-span-2">
                    <label class="mb-2 block text-sm font-medium text-slate-700">"Why choose us" text</label>
                    <textarea name="why_choose_text" rows="3" class="w-full rounded-xl border border-slate-200 px-4 py-3 focus:border-emerald-500 focus:outline-none">{{ old('why_choose_text', $settings['why_choose_text'] ?? 'We focus on reliable product quality, discreet shipping and a smooth shopping experience for healthcare essentials.') }}</textarea>
                </div>
            </div>

            <div class="mt-8 flex justify-end">
                <button type="submit" class="rounded-full bg-emerald-600 px-5 py-2.5 text-sm font-semibold text-white hover:bg-emerald-500">Save settings</button>
            </div>
        </form>
    </div>
</div>
</x-app-layout>
