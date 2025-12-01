<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>FashionablyLate</title>
  <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}">
  <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
</head>

<body>
  <header class="header">
    <div class="header__inner">
      <div class="header-utilities">
        <a class="header__logo" href="/">
          FashionablyLate
        </a>
        <nav>
          <ul class="header-nav">
            @if (Auth::check())
            <li class="header-nav__item">
              <a class="header-nav__link" href="/login">logout</a>
            </li>
            @endif
          </ul>
        </nav>
      </div>
    </div>
  </header>

  <main>
    <div class="admin__content">
      <div class="admin__heading">
        <h2>Admin</h2>
      </div>
      <form class="search-form" action="/contacts/search" method="get">
        <div class="search-form__item">
          <input class="search-form__item-name" type="text" name="keyword" placeholder="名前やメールアドレスを入力してください" value="{{ old('keyword') }}">
          <select class="search-form__item-gender" name="gender">
            <option value="">性別</option>
            <option value="1" @selected(request('gender') == '1')>男性</option>
            <option value="2" @selected(request('gender') == '2')>女性</option>
            <option value="3" @selected(request('gender') == '3')>その他</option>
          </select>
          <select class="search-form__item-content" name="category_id">
            <option value="">お問い合わせの種類</option>
            @foreach ($categories as $category)
              <option value="{{ $category->id }}" @selected(request('category_id') == $category)>
              {{ $category->content }}
              </option>
            @endforeach
          </select>
            <input class="search-form__item-date" type="date" name="date" value="{{ request('date') }}">
        </div>
        <div class="search-form__button">
          <button class="search-form__button-submit" type="submit">検索</button>
          <a href="/admin" class="search-form__button-reset">リセット</a>
        </div>
      </form>
      <div class="pagination-wrapper">
        {{ $contacts->links('pagination::bootstrap-4') }}
      </div>
      <div class="admin-table">
        <table class="admin-table__inner">
          <tr class="admin-table__row">
            <th class="admin-table__header">
              <span class="admin-table__header-name">お名前</span>
              <span class="admin-table__header-gender">性別</span>
              <span class="admin-table__header-email">メールアドレス</span>
              <span class="admin-table__header-content">お問い合わせの種類</span>
            </th>
          </tr>
          @foreach ($contacts as $contact)
          <tr class="admin-table__row">
            <td class="admin-table__item">
              <span class="info-form__item-name">{{ $contact['last_name'] }}{{ $contact['first_name'] }}</span>
              <span class="info-form__item-gender">{{ $contact['gender'] == 1 ? '男性' : ($contact['gender'] == 2 ? '女性' : 'その他') }}</span>
              <span class="info-form__item-email">{{ $contact['email'] }}</span>
              <span class="info-form__item-content">{{ $contact->category->content }}</span>
              <button class="detail-btn" type="button" onclick="this.nextElementSibling.showModal()">詳細</button>
              <dialog class="contact-modal">
                <form method="dialog" class="modal-close-form">
                  <button class="modal-close-btn">&times;</button>
                </form>
                <p><strong>お名前:</strong> {{ $contact['last_name'] }}{{ $contact['first_name'] }}</p>
                <p><strong>性別:</strong>{{ $contact['gender'] == 1 ? '男性' : ($contact['gender'] == 2 ? '女性' : 'その他') }}
                </p>
                <p><strong>メールアドレス:</strong> {{ $contact['email'] }}</p>
                <p><strong>電話番号:</strong> {{ is_array($contact['tel']) ? implode('-', $contact['tel']) : $contact['tel'] }}</p>
                <p><strong>住所:</strong> {{ $contact['address'] }}</p>
                <p><strong>建物名:</strong> {{ $contact['building'] }}</p>
                <p><strong>お問い合わせの種類:</strong> {{ $contact->category->content }}</p>
                <p><strong>お問い合わせ内容:</strong> {{ $contact['detail'] }}</p>
                <form action="{{ route('contacts.destroy', $contact->id) }}" method="post" class="modal-delete-form">
                @csrf
                @method('DELETE')
                  <button type="submit" class="modal-delete-btn">削除</button>
                </form>
              </dialog>
            </th>
          </tr>
          @endforeach
        </table>
      </div>
    </div>
  </main>
</body>

</html>