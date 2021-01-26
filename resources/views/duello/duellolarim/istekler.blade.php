<x-app-layout>
    <x-slot name="header">Düellolarım</x-slot>

    <div class="sm:flex bg-gray-100 border border-gray-200 overflow-x-auto">
        <a href="{{ route('duellolarim') }}">
            <div class="border-b sm:border-b-0 sm:border-r border-gray-300 py-1 sm:py-3 px-2 px-1">
                Tamamlananlar <b class="text-gray-500">({{ count($data['biten']) }})</b>
            </div>
        </a>
        <a href="?durum=devam-edenler">
            <div class="border-b sm:border-b-0 sm:border-r border-gray-300 py-1 sm:py-3 px-2 px-1">
                Devam Edenler <b
                    class="text-gray-500">({{ count($data['devameden']) + $data['kabulbekleyen']->count() }})</b>
            </div>
        </a>
        <div class="bg-gray-300 sm:border-r border-gray-300 py-1 sm:py-3 px-2 px-1">
            İstekler <b class="text-red-600">({{ $data['istekler']->count() }})</b>
        </div>
    </div>
    <div class="mt-4 sm:m-5">
        <h1 class="text-xl font-bold">Düello İstekleri</h1>
        <div class="mt-2 sm:p-3 bg-gray-100 border border-gray-200 rounded-md">
            @forelse($data['istekler'] as $duello)
                <?php
                $gonderen = \App\Models\User::find($duello->olusturan_id);
                ?>
                <div
                    class="flex flex-wrap items-center justify-between bg-blue-100 border border-blue-200 hover:bg-blue-200 p-2 transition @if (!$loop->first) border-t-0 @endif">
                    @if ($gonderen->id == \Illuminate\Support\Facades\Auth::user()->id)
                        <h1><i class="fas fa-angle-double-right"></i> Gönderilen</h1>
                        <p>Kime: <a href="{{ route('profil', $giden->name) }}"
                                    class="text-blue-500 font-bold">{{ $giden->name }}</a>
                    @else
                        <div>
                            <h1 class="text-yellow-600 font-bold text-xl"><i class="fas fa-angle-double-left"></i> Gelen
                            </h1>
                            <div class="w-full"></div>
                            <p>Kimden: <a href="{{ route('profil', $gonderen->name) }}"
                                          class="text-blue-500 font-bold">{{ $gonderen->name }}</a>
                                @endif</p>
                            <p>Kategori:
                                <b>{{ $data['kategoriler']->where('link', $duello->kategori)->first()->isim }}</b></p>
                        </div>
                        <a href="{{ route('duello_onizleme', $duello->uniqueid) }}">
                            <button class="btn--primary">Gör</button>
                        </a>
                </div>
            @empty
                <div class="text-center text-gray-600 w-full p-10 border border-gray-200 rounded-md bg-gray-100"><p>Bekleyen düello isteği bulunamadı.</p></div>
            @endforelse
        </div>
    </div>
</x-app-layout>
