<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Remote Sales Registration — SiteDudes</title>
    <style>
        :root {
            --orange: #f59a19;
            --dark: #30363d;
            --bg: #f3f4f6;
            --text: #202936;
            --muted: #667085;
            --border: #e1e5eb;
        }

        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            background: var(--bg);
            color: var(--text);
            font: 15px/1.65 system-ui, -apple-system, Segoe UI, sans-serif;
        }

        header {
            background: var(--dark);
            color: white;
            padding: 17px max(22px, calc((100vw - 1160px) / 2));
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .brand {
            font: bold italic 30px Georgia, serif;
            color: var(--orange);
        }

        .brand span {
            color: white;
        }

        .container {
            max-width: 800px;
            margin: 32px auto;
            padding: 0 22px 70px;
        }

        h1 {
            font-size: 32px;
            line-height: 1.2;
            margin: 0 0 10px 0;
        }

        .lead {
            font-size: 17px;
            color: #465263;
            margin: 0 0 16px 0;
        }

        .card {
            background: white;
            border: 1px solid var(--border);
            border-radius: 12px;
            padding: 24px;
            margin: 18px 0;
            box-shadow: 0 2px 8px #10182809;
        }

        .grid {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 15px;
        }

        label {
            font-size: 13px;
            font-weight: 600;
            display: block;
            margin-bottom: 5px;
        }

        input,
        select,
        textarea {
            width: 100%;
            border: 1px solid #cbd2dc;
            border-radius: 6px;
            padding: 10px 12px;
            font: inherit;
            background: #fff;
            color: var(--text);
        }

        textarea {
            min-height: 75px;
        }

        button {
            background: var(--orange);
            border: 0;
            color: white;
            padding: 10px 15px;
            border-radius: 6px;
            cursor: pointer;
            font-weight: 650;
            font-size: 15px;
        }

        button.secondary {
            background: white;
            color: #374151;
            border: 1px solid #cbd2dc;
        }

        button:disabled {
            opacity: 0.45;
            cursor: not-allowed;
        }

        .actions {
            display: flex;
            gap: 9px;
            flex-wrap: wrap;
            justify-content: space-between;
            margin-top: 16px;
        }

        .muted,
        .caption {
            color: var(--muted);
            font-size: 13px;
        }

        .caption {
            margin-top: 10px;
        }

        .badge {
            display: inline-block;
            padding: 3px 9px;
            border-radius: 15px;
            background: #fff2db;
            color: #995600;
            font-size: 12px;
            font-weight: 650;
        }

        .pills {
            display: flex;
            gap: 8px;
            margin: 12px 0;
        }

        .pill {
            flex: 1;
            background: #e8ebef;
            height: 6px;
            border-radius: 6px;
        }

        .pill.active {
            background: var(--orange);
        }

        .note {
            border-left: 4px solid var(--orange);
            background: #fff9ef;
            padding: 13px 16px;
            margin: 18px 0;
        }

        .hidden {
            display: none !important;
        }

        .checkline {
            display: flex;
            align-items: flex-start;
            gap: 8px;
        }

        .checkline input {
            width: auto;
            margin-top: 6px;
        }

        canvas {
            border: 1px solid #cbd2dc;
            border-radius: 6px;
            width: 100%;
            height: 150px;
            touch-action: none;
            display: block;
        }

        .file-input-wrapper {
            position: relative;
            overflow: hidden;
            display: inline-block;
            width: 100%;
        }

        .file-input-wrapper input[type=file] {
            position: absolute;
            left: -9999px;
        }

        .file-label {
            display: inline-block;
            padding: 10px 12px;
            background: #fff;
            border: 1px solid #cbd2dc;
            border-radius: 6px;
            cursor: pointer;
            width: 100%;
            text-align: center;
        }

        .file-label:hover {
            background: #f9f9f9;
        }

        .file-name {
            margin-top: 5px;
            font-size: 13px;
            color: var(--muted);
        }

        .error-message {
            color: #dc2626;
            font-size: 13px;
            margin-top: 5px;
        }

        .success-message {
            color: #187047;
            font-size: 13px;
            margin-top: 5px;
        }

        footer {
            padding: 25px;
            text-align: center;
            color: #667085;
            font-size: 12px;
        }

        .step-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 16px;
        }

        .step-header h2 {
            margin: 0;
            font-size: 24px;
        }

        @media (max-width: 700px) {
            .grid {
                grid-template-columns: 1fr;
            }

            .container {
                padding: 0 14px;
            }

            h1 {
                font-size: 27px;
            }

            .card {
                padding: 16px;
            }

            .actions {
                flex-direction: column;
            }

            button {
                width: 100%;
            }
        }
    </style>
</head>
<body>
    <header>
        <div class="brand">Site<span>Dudes</span></div>
        <div>Remote Sales Registration</div>
    </header>

    <div class="container">
        <h1>Remote Sales Registration</h1>
        <p class="lead">Complete your profile to get started as a Remote Sales Representative.</p>

        <div class="card">
            <div class="step-header">
                <h2 style="margin: 0">Registration Form</h2>
                <span class="badge" id="stepBadge">Step 1 of 3</span>
            </div>

            <div class="pills">
                <div class="pill active" id="pill0"></div>
                <div class="pill" id="pill1"></div>
                <div class="pill" id="pill2"></div>
            </div>

            <p class="muted" id="stepName">Step 1 of 3 — Personal Information</p>

            <form id="registrationForm">
                @csrf

                <!-- Step 1: Personal Information -->
                <div id="step0" class="step-content">
                    <div class="grid">
                        <div>
                            <label for="firstName">First Name *</label>
                            <input type="text" id="firstName" name="first_name" placeholder="First name" required>
                            <div class="error-message" id="error-first_name"></div>
                        </div>
                        <div>
                            <label for="lastName">Last Name *</label>
                            <input type="text" id="lastName" name="last_name" placeholder="Last name" required>
                            <div class="error-message" id="error-last_name"></div>
                        </div>
                        <div>
                            <label for="email">Email *</label>
                            <input type="email" id="email" name="email" placeholder="name@example.com" required>
                            <div class="error-message" id="error-email"></div>
                        </div>
                        <div>
                            <label for="dateOfBirth">Date of Birth</label>
                            <input type="date" id="dateOfBirth" name="date_of_birth">
                            <div class="error-message" id="error-date_of_birth"></div>
                        </div>
                        <div>
                            <label for="gender">Gender</label>
                            <select id="gender" name="gender">
                                <option value="">Select gender</option>
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>
                                <option value="Other">Other</option>
                                <option value="Prefer not to say">Prefer not to say</option>
                            </select>
                            <div class="error-message" id="error-gender"></div>
                        </div>
                        <div>
                            <label for="jobTitle">Job Title</label>
                            <input type="text" id="jobTitle" name="job_title" placeholder="Sales Representative">
                            <div class="error-message" id="error-job_title"></div>
                        </div>
                        <div>
                            <label for="phone">Phone *</label>
                            <input type="tel" id="phone" name="phone" placeholder="Phone number" required>
                            <div class="error-message" id="error-phone"></div>
                        </div>
                        <div>
                            <label for="address">Address *</label>
                            <input type="text" id="address" name="address" placeholder="Full address" required>
                            <div class="error-message" id="error-address"></div>
                        </div>
                        <div>
                            <label for="password">Password *</label>
                            <input type="password" id="password" name="password" placeholder="Password" required>
                            <div class="caption">Minimum 8 characters</div>
                            <div class="error-message" id="error-password"></div>
                        </div>
                        <div>
                            <label for="passwordConfirmation">Confirm Password *</label>
                            <input type="password" id="passwordConfirmation" name="password_confirmation" placeholder="Confirm password" required>
                            <div class="error-message" id="error-password_confirmation"></div>
                        </div>
                    </div>
                </div>

                <!-- Step 2: Identity Verification -->
                <div id="step1" class="step-content hidden">
                    <div class="note">
                        <strong>Identity Verification</strong>
                        <p>Upload clear images of both sides of a government-issued photo ID. The files must be stored privately and reviewed only by authorized administrators.</p>
                    </div>

                    <div>
                        <label for="photoIdFront">Photo ID — Front *</label>
                        <div class="file-input-wrapper">
                            <input type="file" id="photoIdFront" name="photo_id_front" accept="image/png,image/jpeg,application/pdf" required>
                            <label for="photoIdFront" class="file-label">Choose file or drag here</label>
                        </div>
                        <div class="file-name" id="photoIdFrontName"></div>
                        <div class="error-message" id="error-photo_id_front"></div>
                    </div>

                    <div style="margin-top: 20px;">
                        <label for="photoIdBack">Photo ID — Back *</label>
                        <div class="file-input-wrapper">
                            <input type="file" id="photoIdBack" name="photo_id_back" accept="image/png,image/jpeg,application/pdf" required>
                            <label for="photoIdBack" class="file-label">Choose file or drag here</label>
                        </div>
                        <div class="file-name" id="photoIdBackName"></div>
                        <div class="error-message" id="error-photo_id_back"></div>
                    </div>
                </div>

                <!-- Step 3: Terms and Signature -->
                <div id="step2" class="step-content hidden">
                    <div class="note">
                        <strong>Sales Representative Agreement</strong>
                        <p>By signing below, you acknowledge that you have read, understood, and agree to all terms, commission policies, confidentiality provisions and the privacy notice provided by SiteDudes.</p>
                    </div>

                    <div style="margin-bottom: 20px;">
                        <label class="checkline">
                            <input type="checkbox" id="terms" name="terms_accepted" required>
                            <span>I have read and agree to the Terms and Conditions *</span>
                        </label>
                        <div class="error-message" id="error-terms_accepted"></div>
                    </div>

                    <div>
                        <label for="signature">Electronic Signature *</label>
                        <canvas id="signature" width="800" height="200"></canvas>
                        <div class="caption">Please sign above using your mouse or touch screen</div>
                        <div class="actions">
                            <button type="button" class="secondary" onclick="clearSignature()">Clear signature</button>
                        </div>
                        <div class="error-message" id="error-signature"></div>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="actions">
                    <button type="button" id="backBtn" class="secondary" onclick="moveStep(-1)" disabled>← Back</button>
                    <button type="button" id="nextBtn" onclick="moveStep(1)">Continue →</button>
                </div>

                <p class="caption" id="formMessage"></p>
            </form>
        </div>
    </div>

    <footer>SiteDudes CRM — Remote Sales Registration. All information is securely stored and protected.</footer>

    <script>
        let currentStep = 0;
        let signed = false;
        const canvas = document.getElementById('signature');
        const ctx = canvas.getContext('2d');
        let drawing = false;

        // Initialize canvas for signature
        function initSignaturePad() {
            canvas.addEventListener('pointerdown', (e) => {
                drawing = true;
                canvas.setPointerCapture(e.pointerId);
                const p = coords(e);
                ctx.beginPath();
                ctx.moveTo(...p);
                ctx.lineWidth = 2;
                ctx.lineCap = 'round';
                ctx.strokeStyle = '#253247';
            });

            canvas.addEventListener('pointermove', (e) => {
                if (!drawing) return;
                ctx.lineTo(...coords(e));
                ctx.stroke();
                signed = true;
            });

            canvas.addEventListener('pointerup', () => {
                drawing = false;
            });
        }

        function coords(e) {
            const r = canvas.getBoundingClientRect();
            return [
                (e.clientX - r.left) * canvas.width / r.width,
                (e.clientY - r.top) * canvas.height / r.height
            ];
        }

        function clearSignature() {
            ctx.clearRect(0, 0, canvas.width, canvas.height);
            signed = false;
        }

        // File input handlers
        document.getElementById('photoIdFront')?.addEventListener('change', function() {
            document.getElementById('photoIdFrontName').textContent = this.files[0] ? this.files[0].name : '';
        });

        document.getElementById('photoIdBack')?.addEventListener('change', function() {
            document.getElementById('photoIdBackName').textContent = this.files[0] ? this.files[0].name : '';
        });

        // Form submission
        async function submitStep(stepNum) {
            const form = document.getElementById('registrationForm');
            const formData = new FormData(form);

            let url, dataToSend;

            if (stepNum === 1) {
                url = '{{ route("register.step1") }}';
                dataToSend = new FormData();
                dataToSend.append('_token', formData.get('_token'));
                dataToSend.append('first_name', document.getElementById('firstName').value);
                dataToSend.append('last_name', document.getElementById('lastName').value);
                dataToSend.append('email', document.getElementById('email').value);
                dataToSend.append('date_of_birth', document.getElementById('dateOfBirth').value);
                dataToSend.append('gender', document.getElementById('gender').value);
                dataToSend.append('job_title', document.getElementById('jobTitle').value);
                dataToSend.append('phone', document.getElementById('phone').value);
                dataToSend.append('address', document.getElementById('address').value);
                dataToSend.append('password', document.getElementById('password').value);
                dataToSend.append('password_confirmation', document.getElementById('passwordConfirmation').value);
            } else if (stepNum === 2) {
                url = '{{ route("register.step2") }}';
                dataToSend = new FormData();
                dataToSend.append('_token', formData.get('_token'));
                dataToSend.append('photo_id_front', document.getElementById('photoIdFront').files[0]);
                dataToSend.append('photo_id_back', document.getElementById('photoIdBack').files[0]);
            } else if (stepNum === 3) {
                url = '{{ route("register.step3") }}';
                dataToSend = new FormData();
                dataToSend.append('_token', formData.get('_token'));
                dataToSend.append('terms_accepted', document.getElementById('terms').checked ? '1' : '0');
                dataToSend.append('signature', canvas.toDataURL('image/png'));
            }

            try {
                clearErrors();
                const response = await fetch(url, {
                    method: 'POST',
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                    },
                    body: dataToSend
                });

                const data = await response.json();

                if (!response.ok) {
                    if (data.errors) {
                        displayErrors(data.errors);
                    } else {
                        document.getElementById('formMessage').textContent = data.error || 'An error occurred';
                    }
                    return false;
                }

                return true;
            } catch (error) {
                document.getElementById('formMessage').textContent = 'Network error: ' + error.message;
                return false;
            }
        }

        function clearErrors() {
            document.querySelectorAll('.error-message').forEach(el => {
                el.textContent = '';
            });
        }

        function displayErrors(errors) {
            for (const [field, messages] of Object.entries(errors)) {
                const errorEl = document.getElementById(`error-${field}`);
                if (errorEl) {
                    errorEl.textContent = messages[0];
                }
            }
        }

        function moveStep(delta) {
            if (delta > 0) {
                if (!submitStep(currentStep + 1)) {
                    return;
                }
            }

            currentStep = Math.min(2, Math.max(0, currentStep + delta));

            // Update UI
            for (let i = 0; i < 3; i++) {
                document.getElementById(`step${i}`).classList.toggle('hidden', i !== currentStep);
                document.getElementById(`pill${i}`).classList.toggle('active', i === currentStep);
            }

            document.getElementById('backBtn').disabled = currentStep === 0;
            document.getElementById('nextBtn').textContent = currentStep === 2 ? 'Submit Registration' : 'Continue →';
            document.getElementById('stepName').textContent = `Step ${currentStep + 1} of 3 — ${['Personal Information', 'Identity Verification', 'Terms and Signature'][currentStep]}`;

            if (currentStep === 2) {
                document.getElementById('stepBadge').textContent = 'Final Step';
            } else {
                document.getElementById('stepBadge').textContent = `Step ${currentStep + 1} of 3`;
            }

            if (currentStep === 2) {
                initSignaturePad();
                const nextBtn = document.getElementById('nextBtn');
                nextBtn.onclick = async () => {
                    if (!signed) {
                        document.getElementById('error-signature').textContent = 'Please provide a signature';
                        return;
                    }
                    if (!document.getElementById('terms').checked) {
                        document.getElementById('error-terms_accepted').textContent = 'You must accept the terms';
                        return;
                    }
                    const success = await submitStep(3);
                    if (success) {
                        document.getElementById('formMessage').textContent = '';
                        document.getElementById('registrationForm').style.display = 'none';
                        document.querySelector('.step-header').innerHTML = '<h2 style="margin: 0; color: #187047;">Registration Complete</h2>';
                        document.querySelector('.pills').innerHTML = '<p style="color: #187047; font-weight: 600;">Thank you for registering!</p>';
                        document.querySelector('#stepName').textContent = 'Your application has been submitted. Please check your email to verify your account.';
                    }
                };
            } else {
                document.getElementById('nextBtn').onclick = () => moveStep(1);
            }
        }

        // Initialize
        document.addEventListener('DOMContentLoaded', () => {
            clearErrors();
            document.getElementById('formMessage').textContent = '';
        });
    </script>
</body>
</html>
