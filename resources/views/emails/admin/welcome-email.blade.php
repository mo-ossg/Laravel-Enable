<x-mail::message>
# Welcome, {{$admin->name}}

Thanks for your cooperation and support,

<x-mail::panel>
To access CMS, click on below button.
</x-mail::panel>

<x-mail::button :url="'http://127.0.0.1:8000/cms/admin'" color="primary">
CMS Login
</x-mail::button>

{{-- <x-mail::table>
| Product       | Quantity      | Total    |
|:------------- |:-------------:| --------:|
| Burger | 2 | $18 |
| Pissa  | 3 | $25 |
</x-mail::table> --}}

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
