<footer class="footer-gradient text-white py-12 mt-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
            <div>
                <div class="flex items-center space-x-2 mb-4">
                    <div class="w-8 h-8 bg-indigo-600 rounded-lg flex items-center justify-center">
                        <i class="fas fa-lightbulb text-white"></i>
                    </div>
                    <h3 class="text-2xl font-bold">Insights Hub</h3>
                </div>
                <p class="text-gray-400 text-sm">Your trusted source for business insights, industry trends, and expert
                    perspectives.</p>
            </div>
            <div>
                <h4 class="font-bold mb-4">Quick Links</h4>
                <ul class="space-y-2 text-sm">
                    <li><a href="{{ route('home') }}" class="text-gray-400 hover:text-white transition">About Us</a>
                    </li>
                    <li><a href="{{ route('home') }}" class="text-gray-400 hover:text-white transition">Contact</a></li>
                    <li><a href="#" class="text-gray-400 hover:text-white transition">Advertise</a></li>
                    <li><a href="{{ route('home') }}" class="text-gray-400 hover:text-white transition">Privacy
                            Policy</a></li>
                </ul>
            </div>
            <div>
                <h4 class="font-bold mb-4">Categories</h4>
                <ul class="space-y-2 text-sm">
                    @foreach($categories as $category)
                        <li><a href="{{ route('home') }}"
                               class="text-gray-400 hover:text-white transition">{{ $category->name }}</a></li>
                    @endforeach
                </ul>
            </div>
            <div>
                <h4 class="font-bold mb-4">Follow Us</h4>
                <div class="flex space-x-4">
                    <a href="#"
                       class="w-10 h-10 bg-gray-800 rounded-full flex items-center justify-center text-gray-400 hover:text-white hover:bg-indigo-600 transition">
                        <i class="fab fa-twitter"></i>
                    </a>
                    <a href="#"
                       class="w-10 h-10 bg-gray-800 rounded-full flex items-center justify-center text-gray-400 hover:text-white hover:bg-indigo-600 transition">
                        <i class="fab fa-linkedin-in"></i>
                    </a>
                    <a href="#"
                       class="w-10 h-10 bg-gray-800 rounded-full flex items-center justify-center text-gray-400 hover:text-white hover:bg-indigo-600 transition">
                        <i class="fab fa-facebook-f"></i>
                    </a>
                    <a href="#"
                       class="w-10 h-10 bg-gray-800 rounded-full flex items-center justify-center text-gray-400 hover:text-white hover:bg-indigo-600 transition">
                        <i class="fab fa-instagram"></i>
                    </a>
                </div>
            </div>
        </div>
        <div class="border-t border-gray-800 mt-8 pt-8 text-center text-gray-400 text-sm">
            <p>&copy; {{ date('Y') }} Insights Hub. All rights reserved.</p>
        </div>
    </div>
</footer>