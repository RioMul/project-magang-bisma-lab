{{-- MODAL PENGINGAT PILIH TEMPLATE --}}
<div id="templateReminderModal" class="fixed inset-0 bg-slate-900/60 backdrop-blur-sm z-50 flex items-center justify-center p-4 hidden">
    <div class="bg-white rounded-2xl max-w-sm w-full p-6 text-center shadow-2xl border border-slate-100 transform transition-all scale-95" id="modalBox">
        <div class="w-12 h-12 bg-amber-50 border border-amber-200 text-amber-500 rounded-full flex items-center justify-center mx-auto text-xl mb-4 font-bold">
            💡
        </div>
        <h3 class="text-lg font-black text-slate-800">Pilih Desain Web Terlebih Dahulu</h3>
        <p class="text-xs text-slate-500 mt-2 leading-relaxed">
            Untuk mengonfigurasi paket server dan domain dengan tepat, silakan tentukan template website yang ingin Anda gunakan.
        </p>
        <div class="mt-6 flex flex-col gap-2">
            <a href="{{ route('order.template') }}" class="w-full py-2.5 bg-[#0396c7] hover:bg-[#027ea7] text-white font-bold text-xs rounded-xl shadow-md transition">
                Pilih Template Sekarang
            </a>
            <button type="button" onclick="closeTemplateModal()" class="w-full py-2 bg-slate-100 hover:bg-slate-200 text-slate-600 font-semibold text-xs rounded-xl transition">
                Kembali
            </button>
        </div>
    </div>
</div>

<script>
    function triggerNeedTemplateModal() {
        const modal = document.getElementById('templateReminderModal');
        const box = document.getElementById('modalBox');
        if (modal && box) {
            modal.classList.remove('hidden');
            setTimeout(() => {
                box.classList.remove('scale-95');
                box.classList.add('scale-100');
            }, 10);
        }
    }

    function closeTemplateModal() {
        const modal = document.getElementById('templateReminderModal');
        const box = document.getElementById('modalBox');
        if (modal && box) {
            box.classList.remove('scale-100');
            box.classList.add('scale-95');
            setTimeout(() => {
                modal.classList.add('hidden');
            }, 150);
        }
    }
</script>