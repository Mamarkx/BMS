<x-layout>
    <section id="services" class="py-24 bg-white min-h-screen">
        <div class="container mx-auto px-4 md:px-6">
            <div class="text-center mb-16">
                <div class="inline-flex items-center rounded-full px-4 py-1 mb-4 bg-blue-100 text-blue-800 border-blue-200">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="mr-2 w-4 h-4">
                        <path d="M14.5 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V7.5L14.5 2z"></path>
                        <polyline points="14 2 14 8 20 8"></polyline>
                        <line x1="16" x2="8" y1="13" y2="13"></line>
                        <line x1="16" x2="8" y1="17" y2="17"></line>
                        <line x1="10" x2="8" y1="9" y2="9"></line>
                    </svg>
                    Our Services
                </div>
                <h2 class="text-4xl font-bold text-blue-900 mb-4">How can we help you?</h2>
                <p class="text-xl text-blue-700 max-w-3xl mx-auto">
                    Access all government services digitally. No more long queues, no more paperwork hassles.
                </p>
            </div>
            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach ($services as $service)
                    <div class="bg-white p-8 rounded-xl shadow-lg border border-l-5   border-blue-600 transition-all duration-300 ease-in-out hover:-translate-y-1 hover:shadow-xl">
                        <div class="flex items-center justify-center w-12 h-12 bg-blue-100 text-blue-600 rounded-xl mb-4">
                            {!! $service['icon'] !!}
                        </div>
                        <h3 class="text-xl font-semibold text-gray-800 mb-2">{{ $service['title'] }}</h3>
                        <p class="text-gray-600 mb-4 text-sm">{{ $service['description'] }}</p>
                        <a href="{{ route('service.form', ['service_slug' => Str::slug($service['title'])]) }}" class="text-blue-600 font-semibold flex items-center transition-all duration-300 hover:text-blue-700">
                            Request Now
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-4 h-4 ml-2">
                                <path d="M5 12h14"></path>
                                <path d="m12 5 7 7-7 7"></path>
                            </svg>
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
</x-layout>
