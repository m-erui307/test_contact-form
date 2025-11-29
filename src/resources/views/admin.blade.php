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
          <input class="search-form__item-name" type="text" name="keyword" value="{{ old('keyword') }}">
          <select class="search-form__item-gender" name="gender">
            <option value="">性別</option>
            @foreach ($contacts as $contact)
            <option value="{{ $contact['gender'] }}">{{ $contact['gender'] }}</option>
            @endforeach
          </select>
          <select class="search-form__item-content" name="category_id">
            <option value="">お問い合わせの種類</option>
            @foreach ($contacts as $contact)
            <option value="{{ $contact['category_id'] }}">{{ $contact['category_id'] }}</option>
            @endforeach
          </select>
          <select class="search-form__item-date">
            <option value="">年/月/日</option>
          </select>
        </div>
        <div class="search-form__button">
          <button class="search-form__button-submit" type="submit">検索</button>
        </div>
      </form>
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
              <form class="info-form" action="/" method="POST">
                <div class="info-form__item">
                  <p class="info-form__item-name">{{ $contact['last_name'] }}{{ $contact['first_name'] }}</p>
                </div>
                <div class="info-form__item">
                  <p class="info-form__item-gender">{{ $contact['gender'] }}</p>
                </div>
                <div class="info-form__item">
                  <p class="info-form__item-email">{{ $contact['email'] }}</p>
                </div>
                <div class="info-form__item">
                  <p class="info-form__item-content">{{ $contact->category->content }}</p>
                </div>
                <div class="info-form__item">
                  <p class="info-form__item-x">詳細</p>
                </div>
              </form>
            </td>
          </tr>
          @endforeach
        </table>
      </div>
    </div>
  </main>
</body>