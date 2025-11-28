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
      <form class="search-form">
        <div class="search-form__item">
          <input class="search-form__item-name" type="text" />
          <select class="search-form__item-gender">
            <option value="">性別</option>
          </select>
          <select class="search-form__item-content">
            <option value="">お問い合わせの種類</option>
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
          <tr class="admin-table__row">
            <td class="admin-table__item">
              <form class="info-form" action="/" method="POST">
                <div class="info-form__item">
                  <p class="info-form__item-name">山田 太郎</p>
                </div>
                <div class="info-form__item">
                  <p class="info-form__item-gender">男性</p>
                </div>
                <div class="info-form__item">
                  <p class="info-form__item-email">test@example.com</p>
                </div>
                <div class="info-form__item">
                  <p class="info-form__item-content">商品の交換について</p>
                </div>
                <div class="info-form__item">
                  <p class="info-form__item-x">詳細</p>
                </div>
              </form>
            </td>
          </tr>
        </table>
      </div>
    </div>
  </main>
</body>