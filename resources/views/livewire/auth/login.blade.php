<form wire:submit.prevent="login">
    <div class="decoration"></div>
    <div class="decoration"></div>
    <div class="decoration"></div>

    <div class="container-login">
        <!-- Header with gradient background -->
        <div class="header-bg">
            <div class="logo-container">
                <div class="logo">
                    <i class="fas fa-lock"></i>
                </div>
            </div>
        </div>

        <!-- Form container -->
        <div class="form-container">
            <h1 class="form-title">Login NCS</h1>
            <p class="form-subtitle">Masukkan kredensial Anda untuk mengakses sistem</p>

            <!-- Simulated error message -->
            @if ($errorMessage)
                <div class="error-message mt-4">
                    <i class="fas fa-exclamation-circle"></i>
                    <span>{{ $errorMessage }}</span>
                </div>
            @endif

            <form>
                <!-- Username field -->
                <div class="input-group">
                    <i class="fas fa-user input-icon"></i>
                    <input type="text" wire:model="username" class="form-input" placeholder="Username" required>
                    @error('username') <span class="field-error">{{ $message }}</span> @enderror
                </div>

                <!-- Password field -->
                <div class="input-group">
                    <i class="fas fa-lock input-icon"></i>
                    <input type="password" wire:model="password" class="form-input" placeholder="Password" required>
                    @error('password') <span class="field-error">{{ $message }}</span> @enderror
                </div>

                <!-- Remember me & Forgot password -->
                <div class="remember-forgot">
                    <div class="checkbox-container">
                        <input type="checkbox" id="remember">
                        <label for="remember">Ingat saya</label>
                    </div>
                    <a href="#" class="forgot-link">Lupa Password?</a>
                </div>

                <!-- Login button -->
                <button type="submit" class="login-button">
                    Login
                </button>

                <!-- Divider -->
                <div class="divider">
                    <div class="divider-text">atau login dengan</div>
                </div>

                <!-- Social login options -->
                <div class="social-login">
                    <div class="social-btn google">
                        <i class="fab fa-google"></i>
                    </div>
                    <div class="social-btn facebook">
                        <i class="fab fa-facebook-f"></i>
                    </div>
                    <div class="social-btn twitter">
                        <i class="fab fa-twitter"></i>
                    </div>
                </div>

                <!-- Registration link -->
                <div class="register-link">
                    Belum punya akun? <a href="#">Daftar Sekarang</a>
                </div>
            </form>
        </div>
    </div>
</form>
