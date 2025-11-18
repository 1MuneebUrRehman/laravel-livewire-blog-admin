<section class="hero-gradient text-white py-16 md:py-24 relative overflow-hidden">
    <div class="hero-pattern absolute inset-0"></div>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="flex flex-col md:flex-row items-center justify-between">
            <div class="md:w-1/2 mb-10 md:mb-0">
                <h2 class="text-4xl md:text-5xl lg:text-6xl font-bold mb-6 leading-tight">Elevate Your Business
                    Intelligence</h2>
                <p class="text-lg md:text-xl max-w-2xl leading-relaxed opacity-90 mb-8">
                    Discover actionable strategies, industry trends, and expert perspectives that drive business growth.
                    Stay ahead with curated content from thought leaders across technology, marketing, and innovation.
                </p>
                <div class="flex flex-col sm:flex-row space-y-4 sm:space-y-0 sm:space-x-4">
                    <a href="{{ route('home') }}"
                       class="bg-white text-indigo-600 font-semibold py-3 px-6 rounded-lg hover:bg-gray-100 transition text-center">
                        Explore Articles
                    </a>
                    <a href="{{ route('home') }}"
                       class="bg-transparent border-2 border-white text-white font-semibold py-3 px-6 rounded-lg hover:bg-white hover:text-indigo-600 transition text-center">
                        Become a Contributor
                    </a>
                </div>
            </div>
            <div class="md:w-1/2 flex justify-center">
                @if($featuredArticle)
                    <div class="relative w-full max-w-md">
                        <div class="absolute -top-6 -left-6 w-full h-full bg-indigo-400 rounded-2xl opacity-20"></div>
                        <div class="relative bg-white rounded-2xl shadow-xl p-6">
                            <div class="flex items-center space-x-4 mb-4">
                                <div class="w-10 h-10 bg-indigo-100 rounded-full flex items-center justify-center">
                                    <i class="fas fa-user text-indigo-600"></i>
                                </div>
                                <div>
                                    <h4 class="font-bold text-gray-900">{{ $featuredArticle->user->name }}</h4>
                                    <p class="text-sm text-gray-500">{{ $featuredArticle->user->role ?? 'Contributor' }}</p>
                                </div>
                            </div>
                            <h3 class="text-xl font-bold text-gray-900 mb-3">{{ $featuredArticle->title }}</h3>
                            <p class="text-gray-600 mb-4">{{ Str::limit($featuredArticle->excerpt, 100) }}</p>
                            <div class="flex items-center justify-between">
                                <span class="text-sm text-gray-500">{{ $featuredArticle->read_time }} min read</span>
                                <a href="{{ route('home') }}" class="text-sm text-indigo-600 font-medium">Read More
                                    →</a>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</section>