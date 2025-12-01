<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Contact Form</title>
  <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}" />
  <link rel="stylesheet" href="{{ asset('css/confirm.css') }}" />
</head>

<body>
  <header class="header">
    <div class="header__inner">
      <h1 class="header__logo">
        Fashionably Late
      </h1>
    </div>
  </header>

  <main>
    <div class="contact-form__content">
      <div class="contact-form__heading">
        <h2>Confirm</h2>
      </div>
      <form class="form" action="/contacts" method="post">
        @csrf
        <div class="confirm-table">
          <table class="confirm-table__inner">
            <tr class="confirm-table__row">
              <th class="confirm-table__header">お名前</th>
              <td class="confirm-table__text">
                {{ $contact['last_name'] }}{{ $contact['first_name'] }}
                <input type="hidden" name="last_name" value="{{ $contact['last_name'] }}"/>
                <input type="hidden" name="first_name" value="{{ $contact['first_name'] }}"/>
              </td>
            </tr>
            <tr class="confirm-table__row">
              <th class="confirm-table__header">性別</th>
              <td class="confirm-table__text">
                <input type="hidden" name="gender" value="{{ $contact['gender'] }}"/>
                @if ($contact['gender'] == 1)
                  男性
                @elseif ($contact['gender'] == 2)
                  女性
                @elseif ($contact['gender'] == 3)
                  その他
                @endif
              </td>
            </tr>
            <tr class="confirm-table__row">
              <th class="confirm-table__header">メールアドレス</th>
              <td class="confirm-table__text">
                {{ $contact['email'] }}
                <input type="hidden" name="email" value="{{ $contact['email'] }}" readonly />
              </td>
            </tr>
            <tr class="confirm-table__row">
              <th class="confirm-table__header">電話番号</th>
              <td class="confirm-table__text">
                {{ implode('', $contact['tel']) }}
                <input type="hidden" name="tel[]" value="{{ $contact['tel'][0] }}" readonly />
                <input type="hidden" name="tel[]" value="{{ $contact['tel'][1] }}" readonly />
                <input type="hidden" name="tel[]" value="{{ $contact['tel'][2] }}" readonly />
              </td>
            </tr>
            <tr class="confirm-table__row">
              <th class="confirm-table__header">住所</th>
              <td class="confirm-table__text">
                {{ $contact['address'] }}
                <input type="hidden" name="address" value="{{ $contact['address'] }}" readonly />
              </td>
            </tr>
            <tr class="confirm-table__row">
              <th class="confirm-table__header">建物名</th>
              <td class="confirm-table__text">
                {{ $contact['building'] }}
                <input type="hidden" name="building" value="{{ $contact['building'] }}" readonly />
              </td>
            </tr>
            <tr class="confirm-table__row">
              <th class="confirm-table__header">お問い合わせの種類</th>
              <td class="confirm-table__text">
                {{ $contact['category_content'] }}
                <input type="hidden" name="category_id" value="{{ $contact['category_id'] }}" readonly />
              </td>
            </tr>
            <tr class="confirm-table__row">
              <th class="confirm-table__header">お問い合わせ内容</th>
              <td class="confirm-table__text">
                {{ $contact['detail'] }}
                <input type="hidden" name="detail" value="{{ $contact['detail'] }}" readonly />
              </td>
            </tr>
          </table>
        </div>
        <div class="form__button">
          <button class="form__button-submit" type="submit">送信</button>
            <a class="form__button-correct" href="{{ route('index') }}">
              修正
            </a>
        </div>
        </div>
      </form>
    </div>
  </main>
</body>

</html>