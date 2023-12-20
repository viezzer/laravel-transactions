<x-app-layout>
    <div class="max-w-2xl mx-auto p-4 sm:p-6 lg:p-8">
        <a href="{{route('transactions.index')}}" class="mx-auto text-center text-xl text-blue-600">< Voltar</a>
        <form method="POST" action="{{ route('transactions.store') }}" class="mt-6">
            @csrf
            <label class="text-xl">Descrição</label>
            <x-input-error :messages="$errors->get('title')" class="mt-2" />
            <input
                type="text"
                name="title"
                placeholder="{{ old('title') }}"
                class="mb-2 block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"
            >
            <label class="text-xl">Valor</label>
            <x-input-error :messages="$errors->get('amount')" class="mt-2" />
            <input
                type="text"
                name="amount"
                placeholder="{{ old('amount') }}"
                class="mb-2 block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"
            >
            <label class="text-xl">Tipo da transação</label>
            <select name="type" class="mb-2 block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm">
                <option value="income">Receita</option>
                <option value="expense">Despesa</option>
            </select>
            <x-primary-button class="mt-4">{{ __('Enviar') }}</x-primary-button>
        </form>
    </div>
</x-app-layout>