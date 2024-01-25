<h1>Начисление баллов для {{ $user->name }}</h1>
<form action="{{ route('users.charge', $user->id) }}" method="POST">
    @csrf
    <label for="amount">Сумма начисления:</label>
    <input type="number" name="amount" id="amount">
    <label for="date">Дата начисления:</label>
    <input type="date" name="date" id="date">
    <label for="comment">Комментарий:</label>
    <textarea name="comment" id="comment"></textarea>
    <button type="submit">Начислить</button>
</form>
