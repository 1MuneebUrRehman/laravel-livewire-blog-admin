<div class="bg-gray-50">
    <livewire:front.home.navigation/>
    <livewire:front.home.hero-section/>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <livewire:front.home.featured-article/>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Main Content Area -->
            <div class="lg:col-span-2">
                <livewire:front.home.latest-articles/>
                <livewire:front.home.categories-grid/>
            </div>

            <!-- Sidebar -->
            <aside class="lg:col-span-1">
                <livewire:front.home.newsletter-subscription/>
                <livewire:front.home.popular-articles/>
                <livewire:front.home.tags-cloud/>
            </aside>
        </div>
    </div>

    <livewire:front.home.footer/>
</div>
