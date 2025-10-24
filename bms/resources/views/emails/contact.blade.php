<x-mail::message>
    # 📩 New Contact Message

    A curious soul has reached out through your website. Here’s the scoop:

    **👤 Name:** {{ $name }}
    **📧 Email:** {{ $email }}
    **📝 Subject:** {{ $subjectLine }}

    ---

    {{ $messageText }}

    ---

    <x-mail::button :url="'mailto:' . $email">
        Reply to {{ $name }}
    </x-mail::button>

    Kind regards,
    {{ config('app.name') }}
</x-mail::message>
