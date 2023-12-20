<x-app-layout>
    <div class="max-w-2xl mx-auto p-4 sm:p-6 lg:p-8">
        <div class="flex justify-between items-center">
        <a href="{{route('transactions.index')}}" class="text-xl text-blue-600">< Voltar</a>
        <form method="POST" action="{{ route('transactions.destroy', $transaction) }}">
            @csrf
            @method('delete')
            <x-danger-button>{{ __('Deletar') }}</x-danger-button>
        </form>
        </div>
        <form method="POST" action="{{ route('transactions.update', $transaction) }}" class="mt-6">
            @csrf
            @method('patch')
            <x-input-label>Descrição</x-input-label>
            <x-input-error :messages="$errors->get('title')" class="mt-2" />
            <input
                type="text"
                name="title"
                placeholder="{{ old('title') }}"
                value="{{$transaction->title}}"
                class="mb-2 block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"
            >
            <x-input-label>Valor</x-input-label>
            <x-input-error :messages="$errors->get('amount')" class="mt-2" />
            <input
                type="text"
                name="amount"
                placeholder="{{ old('amount') }}"
                value={{abs($transaction->amount)}}
                class="mb-2 block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"
            >
            <x-input-label>Tipo da transação</x-input-label>
            <select name="type" class="mb-2 block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm">
                <option value="income" {{$transaction->amount > 0 ? 'selected': ''}}>Receita</option>
                <option value="expense" {{$transaction->amount <= 0 ? 'selected': ''}}>Despesa</option>
            </select>
            <div class="flex justify-between">
                <x-primary-button class="mt-4">{{ __('Enviar') }}</x-primary-button>
            </div>
        </form>
        
    </div>
</x-app-layout>