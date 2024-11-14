<img src="img/LoginPic.png" alt="" class="img-thumbnail border-0">

<center><small><span class="text-muted">Are you a Staff?</span></small></center>
<h1 class="fs-2 fw-bolder px-2 text-center" style="color: var(--green);">Please, Log In.</h1>

<form class="form-control border-0" action="../backend/redirector.php" method="post">
    <input type="hidden" name="type" value="client-login">
    <!----- Email Input ----->
    <div class="form-floating mb-2">
        <input type="email" name="email" id="email" class="form-control" placeholder="sample@email.com" required>
        <label for="email" id="email-label"><em>Email Address</em></label>
    </div>

    <!----- Password Input ----->
    <div class="form-floating">
        <input type="password" id="pass" name="pass" class="form-control" placeholder="Password" required>
        <label for="pass" id="pass-label"><em>Password</em></label>
    </div>

    <div class="d-flex justify-content-between">
        <!----- See Password ----->
        <div class="form-check mb-3">
            <input class="form-check-input" type="checkbox" value="" id="show-password" onclick="togglePassword()">
            <label class="form-check-label text-muted" for="show-password">
                Show Password
            </label>
        </div>

        <!----- Forgot Password ----->
        <div>
            <div>
                <button type="button" id="forgot-password-btn" style="display: none;"></button>
                <label class="form-check-label forgot-class" id="forgot-password-label">Forgot Password</label>
            </div>
        </div>
    </div>

    <div class="d-grid">
        <button class="btn custom-btn-success" name="login" type="submit">LOGIN</button>
    </div>
</form>

<div id="customForgotPasswordModal" class="custom-modal2">
    <div class="custom-modal-content">
        <span class="custom-close-btn" id="closeCustomModal">&times;</span>
        <h5 class="modal-title mb-3">Forgot Password</h5>
        <form id="forgotPasswordForm" method="POST" action="backend/redirector.php">
            <input type="hidden" name="type" value="forgot-password">
            <div class="mb-3">
                <label for="emailForgot" class="form-label">Email</label>
                <input type="email" id="emailForgot" name="emailForgot" class="form-control" required
                    placeholder="Email Address">
            </div>
            <div class="mb-3">
                <label for="enterGenerated" class="form-label">Enter Generated Code</label>
                <input type="text" id="enterGenerated" name="enterGenerated" class="form-control" required
                    placeholder="Generated Code" disabled>
            </div>
            <button type="button" class="btn btn-secondary mb-3 w-100" id="sendCodeBtn">Send Generated Code</button>
            <div class="mb-3">
                <label for="passwordForgot" class="form-label">Password</label>
                <input type="password" id="passwordForgot" name="passwordForgot" class="form-control" required
                    placeholder="New Password">
            </div>
            <div class="mb-3">
                <label for="confirmPasswordForgot" class="form-label">Confirm Password</label>
                <input type="password" id="confirmPasswordForgot" name="confirmPasswordForgot" class="form-control"
                    required placeholder="Confirm New Password">
            </div>

            <button type="submit" class="btn btn-success w-100" id="submitBtn" disabled>Submit</button>
        </form>
    </div>
</div>

<script>
    const sendCodeBtn = document.getElementById('sendCodeBtn');
    const submitBtn = document.getElementById('submitBtn');
    const emailInput = document.getElementById('emailForgot');
    const generatedCodeInput = document.getElementById('enterGenerated');

    sendCodeBtn.addEventListener('click', () => {
        const email = emailInput.value;

        if (email) {
            fetch('backend/send-code.php', {
                method: 'POST',
                body: JSON.stringify({ email }),
                headers: {
                    'Content-Type': 'application/json',
                },
            })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        alert('Code sent to your email');
                        generatedCodeInput.disabled = false;
                        submitBtn.disabled = false;
                    } else {
                        alert('Error: Could not send code. Please try again later.');
                    }
                })
                .catch(error => {
                    alert('Error: ' + error.message);
                });
        } else {
            alert('Please enter a valid email.');
        }
    });
</script>



<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
    const forgotPasswordLabel = document.getElementById('forgot-password-label');
    const customModal = document.getElementById('customForgotPasswordModal');
    const closeCustomModal = document.getElementById('closeCustomModal');

    forgotPasswordLabel.addEventListener('click', () => {
        customModal.style.display = 'block';
    });

    closeCustomModal.addEventListener('click', () => {
        customModal.style.display = 'none';
    });

    window.addEventListener('click', (event) => {
        if (event.target === customModal) {
            customModal.style.display = 'none';
        }
    });
</script>