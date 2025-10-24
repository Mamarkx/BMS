<x-mail::message>
    # New Contact Form Submission

    A visitor has contacted your website.

    ---

    **Full Name:** {{ $name }}
    **Email Address:** {{ $email }}
    **Subject:** {{ $subjectLine }}

    ---

    **Message:**

    > {{ $messageText }}

    ---

    <x-mail::button :url="'mailto:' . $email">
        Respond to Message
    </x-mail::button>

    Thank you,
    {{ config('app.name') }}
</x-mail::message>
