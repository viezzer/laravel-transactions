<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Transações') }}
        </h2>
    </x-slot>
    <div class="max-w-2xl mx-auto p-4 sm:p-6 lg:p-8">
        <a href="{{route('transactions.create')}}" class="text-xl text-green-600 border-l-green-600 border p-1">Nova Transação</a>
        <div class="">
            <form method="POST" action="{{route('transactions.filtered')}}" class="w-full flex flex-col sm:flex-row mt-6 justify-evenly items-center">
                @csrf
                <x-input-label>Data inicial </x-input-label> 
                <input type="date" name='startDate' value={{$startDate}}>
                <x-input-label>Data final</x-input-label>
                <input type="date" name="endDate" value={{$endDate}}>
                <input type="submit" value="Filtrar" class="border border-1 p-2 border-black mt-4 sm:mt-0">
            <form>
        </div>
        @if(count($transactions) > 0)
            <div class="mt-6">
                @foreach ($transactions as $transaction)
                    <a href="{{route('transactions.edit', $transaction)}}" class="px-2 py-1 flex flex-col bg-white shadow-sm rounded-lg mt-1">
                        <small class="w-full text-sm text-gray-600">{{ $transaction->created_at->format('d/m/Y H:i') }}</small>
                        <div class="flex justify-between items-center">
                            <span class="text-gray-800 text-xl">{{ $transaction->title }}</span>
                            @if($transaction->amount<=0)
                                <p class="text-lg text-red-600">R$ {{ number_format($transaction->amount,2) }}</p>
                            @else
                                <p class="text-lg text-green-600">R$ {{ number_format($transaction->amount,2) }}</p>
                            @endif
                        </div>
                    </a>
                @endforeach
            </div>
        @else
        <p class="text-center mt-4">Nenhuma transação cadastrada.</p>
        @endif
        <div class="mt-4">
        {{$transactions->links()}}
        </div>
    </div>
</x-app-layout>