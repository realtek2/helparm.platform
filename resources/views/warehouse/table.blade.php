<table class="table warehouse-table">
    <tr>
        <th>№</th>
        <th>Имя</th>
        <th>Фонд</th>
        <th>Категория</th>
        <th>Кол-во на складе</th>
        <th width="200px"></th>
    </tr>
    @foreach ($products as $product)
    <tr>
        <td><strong>{{ $product->id }}</strong></td>
        <td class="p-text-color">{{ $product->nomenclature->name }}</td>
        <td><strong>{{ $product->fund->name ?? '-'}}</strong><p class="p-text-color">{{ $product->fund->country }} |  {{ $product->fund->city }}</p></td>
        <td><strong>{{ $product->medicamentsCategory->name }}</strong></td>
        <td><strong>{{ $product->quantity }} шт.</strong></td>
        <td>
            <form action="{{ route('products.destroy', $product->id) }}" method="POST">
                <a class="btn btn-primary" href="{{ route('products.edit', $product->id) }}">Изменить</a>
                {{-- <a class="btn btn-secondary px-5 disabled" href="{{ route('products.my_warehouse', $product->id) }}">Запросить</a> --}}
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">Удалить</button>
            </form>
        </td>
    </tr>
    @endforeach
</table>