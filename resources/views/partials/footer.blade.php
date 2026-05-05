<footer class="bg-[#2E6C9F] text-white">
    <div class="max-w-7xl mx-auto px-6 md:px-25 py-12 md:py-16">
        <div class="flex flex-col md:flex-row justify-between items-start gap-12 md:gap-20">

            {{-- Bagian Logo: Tetap berdampingan di mobile (flex-row) --}}
            <div class="flex flex-row items-center gap-3">
                <img src="{{ asset('images/logo2.png') }}" alt="Logo"
                    class="w-10 h-10 md:w-16 md:h-16 object-contain brightness-0 invert">
                <span class="font-bold text-2xl md:text-4xl tracking-tight">Sikarir</span>
            </div>

            {{-- Bagian Kontak & Sosmed --}}
            <div class="flex flex-col sm:flex-row gap-10 md:gap-24">

                {{-- Kontak Kami --}}
                <div class="flex flex-col items-start">
                    <h4 class="font-bold text-lg mb-4 text-white">Kontak Kami</h4>
                    <ul class="space-y-3 text-sm md:text-base text-blue-50">
                        <li class="flex items-center gap-3">
                            <i class="fas fa-envelope text-xs opacity-70"></i>
                            <span>sikarir@gmail.com</span>
                        </li>
                        <li class="flex items-center gap-3">
                            <i class="fas fa-phone text-xs opacity-70"></i>
                            <span>0838-3933-7642</span>
                        </li>
                    </ul>
                </div>

                {{-- Sosial Media --}}
                <div class="flex flex-col items-start">
                    <h4 class="font-bold text-lg mb-4 text-white">Sosial Media</h4>
                    <ul class="space-y-4 text-sm md:text-base text-blue-50">
                        <li>
                            <a href="#" class="flex items-center gap-3 hover:text-white transition group">
                                <i class="fab fa-facebook text-lg group-hover:scale-110 transition-transform"></i>
                                <span>Sikarir Official</span>
                            </a>
                        </li>
                        <li>
                            <a href="#" class="flex items-center gap-3 hover:text-white transition group">
                                <i class="fab fa-instagram text-lg group-hover:scale-110 transition-transform"></i>
                                <span>Sikarir.official</span>
                            </a>
                        </li>
                        <li>
                            <a href="#" class="flex items-center gap-3 hover:text-white transition group">
                                <i class="fab fa-linkedin text-lg group-hover:scale-110 transition-transform"></i>
                                <span>Sikarir Official</span>
                            </a>
                        </li>
                    </ul>
                </div>

            </div>
        </div>
    </div>

    {{-- Copyright Bar --}}
    <div class="bg-[#1E4A6D] py-6 border-t border-white/5">
        <div class="max-w-7xl mx-auto px-6 md:px-12 text-left">
            <p class="text-[10px] md:text-sm text-blue-100/60 tracking-wide font-medium">
                &copy; 2026 Sikarir. All rights reserved
            </p>
        </div>
    </div>
</footer>
