<x-mail::message>
# Pragyan Montessori & Childcare, PMC

Dear {!! $user->name !!},

Thank you for registering with Pragyan Montessori & Childcare, PMC. To ensure the security of your account, please verify your email address and proceed to set your password.

<x-mail::button :url="$url">
Verify and Set Password
</x-mail::button>

If you did not register for an account with Pragyan Montessori & Childcare, PMC, please disregard this email.

Best regards,<br>
Pragyan Montessori & Childcare, PMC
</x-mail::message>
