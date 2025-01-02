<section>
    <header>
        <h2 class="h4 text-dark">
            Profile Information
        </h2>

        <p class="small text-muted">
            Update your account's profile information and email address
        </p>
    </header>

    <!-- Verification Form -->
    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <!-- Update Profile Form -->
    <form method="post" action="{{ route('user.settings.update') }}" class="mt-4">
        @csrf
        @method('patch')
        

        <!-- Name Field -->
        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input
                type="text"
                class="form-control @error('name') is-invalid @enderror"
                id="name"
                name="name"
                value="{{ old('name', auth()->user()->name) }}"
                required>
            @error('name')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- Email Field -->
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input
                type="email"
                class="form-control @error('email') is-invalid @enderror"
                id="email"
                name="email"
                value="{{ old('email', auth()->user()->email) }}"
                required>
            @error('email')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- Resend Verification Button -->
        @if (!auth()->user()->hasVerifiedEmail())
            <div class="mb-3">
                <p class="small text-danger">
                    Your email address is not verified.
                </p>
                <button form="send-verification" class="btn btn-link p-0">Resend Verification Email</button>
            </div>
        @endif

        <!-- Submit Button -->
        <div class="d-grid">
            <button type="submit" class="btn btn-dark">Update Profile</button>
        </div>
    </form>
</section>
