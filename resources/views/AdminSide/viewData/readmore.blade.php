<x-layout>
    <div class="max-w-3xl mx-auto px-6 py-24">
        <!-- Back Navigation -->
        <a href="{{ url()->previous() }}"
        class="text-md text-gray-500 hover:text-gray-700 mb-10 inline-flex items-center transition">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24"
                stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
            </svg>
            Back
        </a>

        <!-- Blog Article -->
        <article class="space-y-12">
            <!-- Featured Image -->
            @if ($announcement->attachment)
                <img src="{{ asset('storage/' . $announcement->attachment) }}"
                     alt="{{ $announcement->title }}"
                     class="w-full h-auto rounded-xl shadow-sm">
            @endif

            <!-- Title & Meta -->
            <header class="space-y-4">
                <h1 class="text-5xl font-serif font-bold text-gray-900 leading-tight tracking-tight">
                    {{ $announcement->title }}
                </h1>
                <div class="flex items-center text-sm text-gray-500 space-x-4">
                    <span class="px-3 py-1 bg-indigo-50 text-indigo-700 rounded-full font-medium">
                        {{ $announcement->category ?? 'Announcement' }}
                    </span>
                    <span>
                        {{ $announcement->publish_date ? $announcement->publish_date->format('F d, Y') : $announcement->created_at->format('F d, Y') }}
                    </span>
                </div>
            </header>

            <!-- Content -->
            <section class="prose prose-lg prose-indigo max-w-none text-gray-800 leading-relaxed">
                {!! $announcement->content !!}
            </section>

            <!-- Footer -->
            <footer class="border-t pt-8 text-sm text-gray-400">
                <p>Published by Brgy San Agustin Office</p>
            </footer>
        </article>
    </div>
</x-layout>