<section>
    <header>
        <h2 class="h4 text-dark">
            Forgot password?
        </h2>

        <p class="small text-muted">
            Don`t worry, Osaka will help you
        </p>
    </header>

    <form action="{{ route('password.request') }}" class="mt-4">
        <div class="d-grid">
            <button type="submit" class="btn btn-dark">Forgot password</button>
        </div>
    </form>
</section>
