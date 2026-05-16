<!DOCTYPE html>
<html>

<head>
    <!-- Required meta tags -->
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <!-- Favicon icon-->
    <!-- <link rel="shortcut icon" type="image/png" href="../assets/images/logos/favicon.png" /> -->

    <!-- Core Css -->
    <link rel="stylesheet" href="<?= base_url() ?>assets/css/main.css" />
    <style>
    .dashboard-main-wrapper {
        margin: 0;
    }

    .privacy-container {
        max-width: 900px;
        margin: 40px auto;
        padding: 0 20px;
    }

    .privacy-header {
        text-align: center;
        margin-bottom: 40px;
        padding-bottom: 20px;
        border-bottom: 2px solid #e9ecef;
    }

    .privacy-section {
        margin-bottom: 30px;
    }

    .privacy-section h3 {
        color: #2c3e50;
        margin-bottom: 15px;
        font-size: 1.5rem;
    }

    .privacy-section p {
        color: #5a6c7d;
        line-height: 1.8;
        margin-bottom: 12px;
    }

    .privacy-section ul {
        margin-left: 20px;
        color: #5a6c7d;
        line-height: 1.8;
    }

    .privacy-section ul li {
        margin-bottom: 8px;
        list-style-type: disc;
    }

    .back-btn {
        margin-top: 40px;
        text-align: center;
    }

    .last-updated {
        text-align: center;
        color: #6c757d;
        font-style: italic;
        margin-bottom: 30px;
    }
    </style>

    <title>Privacy Policy - School Management System</title>
</head>

<body>
    <div class="dashboard-main-wrapper">
        <div class="privacy-container">

            <!-- Header -->
            <div class="privacy-header">
                <h1 class="fw-bold text-main-600 mb-3">Privacy Policy</h1>
                <p class="last-updated">Last Updated: <?= date('F d, Y') ?></p>
            </div>

            <!-- Introduction -->
            <div class="privacy-section">
                <h3>Introduction</h3>
                <p>Welcome to our School Management System. We are committed to protecting your privacy and ensuring the
                    security of your personal information. This Privacy Policy explains how we collect, use, and
                    safeguard the data of students, teachers, and administrators using our platform.</p>
            </div>

            <!-- Information We Collect -->
            <div class="privacy-section">
                <h3>1. Information We Collect</h3>
                <p>We collect the following types of information to provide and improve our services:</p>

                <h5 class="mt-3 mb-2 fw-semibold">Student Information:</h5>
                <ul>
                    <li>Personal details (name, contact information, address)</li>
                    <li>Academic records and performance data</li>
                    <li>Attendance records</li>
                    <li>Parent/guardian contact information</li>
                    <li>Fee payment history</li>
                    <li>Assignments and homework submissions</li>
                    <li>Exam results and test scores</li>
                    <li>Profile photographs and academic documents</li>
                </ul>

                <h5 class="mt-3 mb-2 fw-semibold">Teacher Information:</h5>
                <ul>
                    <li>Personal and professional details</li>
                    <li>Subjects assigned and qualifications</li>
                    <li>Attendance records (biometric data)</li>
                    <li>Timetable and schedule information</li>
                </ul>

                <h5 class="mt-3 mb-2 fw-semibold">Administrative Data:</h5>
                <ul>
                    <li>User account credentials (encrypted passwords)</li>
                    <li>System usage logs and activity records</li>
                    <li>Communication records (SMS/WhatsApp notifications)</li>
                </ul>
            </div>

            <!-- How We Use Your Information -->
            <div class="privacy-section">
                <h3>2. How We Use Your Information</h3>
                <p>We use the collected information for the following purposes:</p>
                <ul>
                    <li>Managing student enrollment, attendance, and academic records</li>
                    <li>Facilitating communication between administrators, teachers, students, and parents</li>
                    <li>Processing fee payments and generating receipts</li>
                    <li>Scheduling and conducting examinations and publishing results</li>
                    <li>Creating and managing lesson plans, assignments, and homework</li>
                    <li>Sending automated notifications for fees, attendance, and announcements</li>
                    <li>Generating reports and statistics for school administration</li>
                    <li>Improving our services and system functionality</li>
                </ul>
            </div>

            <!-- Data Security -->
            <div class="privacy-section">
                <h3>3. Data Security</h3>
                <p>We take data security seriously and implement the following measures:</p>
                <ul>
                    <li>Passwords are encrypted using industry-standard hashing algorithms</li>
                    <li>Role-based access control ensures users only access authorized information</li>
                    <li>Regular security audits and system updates</li>
                    <li>Secure storage of uploaded documents and certificates</li>
                    <li>Biometric attendance data is stored securely and used only for attendance tracking</li>
                </ul>
            </div>

            <!-- Data Sharing -->
            <div class="privacy-section">
                <h3>4. Data Sharing and Disclosure</h3>
                <p>We do not sell, trade, or rent your personal information to third parties. We may share information
                    only in the following circumstances:</p>
                <ul>
                    <li>With authorized school staff for legitimate educational purposes</li>
                    <li>With parents/guardians regarding their child's academic progress and attendance</li>
                    <li>With payment gateway providers for processing online fee payments (securely encrypted)</li>
                    <li>With SMS/WhatsApp service providers for sending notifications (only contact numbers shared)</li>
                    <li>When required by law or legal proceedings</li>
                </ul>
            </div>

            <!-- Your Rights -->
            <div class="privacy-section">
                <h3>5. Your Rights</h3>
                <p>You have the following rights regarding your personal information:</p>
                <ul>
                    <li>Access your personal data stored in the system</li>
                    <li>Request corrections to inaccurate information</li>
                    <li>Request deletion of your account (subject to legal and administrative requirements)</li>
                    <li>Opt-out of non-essential communications</li>
                    <li>Review your child's academic records (for parents/guardians)</li>
                </ul>
            </div>

            <!-- Data Retention -->
            <div class="privacy-section">
                <h3>6. Data Retention</h3>
                <p>We retain your information for as long as necessary to:</p>
                <ul>
                    <li>Provide educational services to current students</li>
                    <li>Maintain historical admission and academic records</li>
                    <li>Comply with legal and regulatory requirements</li>
                    <li>When a student leaves the school, records are archived and retained for administrative and legal
                        purposes</li>
                </ul>
            </div>

            <!-- Cookies and Tracking -->
            <div class="privacy-section">
                <h3>7. Cookies and Tracking</h3>
                <p>Our system uses cookies and similar technologies to:</p>
                <ul>
                    <li>Maintain user login sessions</li>
                    <li>Remember user preferences</li>
                    <li>Improve system performance and user experience</li>
                    <li>You can control cookie settings through your browser, but disabling cookies may affect system
                        functionality</li>
                </ul>
            </div>

            <!-- Children's Privacy -->
            <div class="privacy-section">
                <h3>8. Children's Privacy</h3>
                <p>Our system is designed for use by educational institutions and includes data of minor students. We
                    take special care to:</p>
                <ul>
                    <li>Collect only necessary information for educational purposes</li>
                    <li>Ensure parental access to their children's information</li>
                    <li>Protect student data with enhanced security measures</li>
                    <li>Parents/guardians can contact the school administration to review or request changes to their
                        child's information</li>
                </ul>
            </div>

            <!-- Third-Party Services -->
            <div class="privacy-section">
                <h3>9. Third-Party Services</h3>
                <p>We may integrate with the following third-party services:</p>
                <ul>
                    <li>Payment gateways for online fee collection</li>
                    <li>SMS and WhatsApp services for notifications</li>
                    <li>Biometric attendance systems</li>
                    <li>These services have their own privacy policies and we recommend reviewing them</li>
                </ul>
            </div>

            <!-- Changes to Privacy Policy -->
            <div class="privacy-section">
                <h3>10. Changes to This Privacy Policy</h3>
                <p>We may update this Privacy Policy from time to time to reflect changes in our practices or legal
                    requirements. We will notify users of any significant changes through:</p>
                <ul>
                    <li>System notifications on dashboards</li>
                    <li>Email or SMS notifications</li>
                    <li>Updated "Last Updated" date at the top of this policy</li>
                </ul>
            </div>

            <!-- Contact Information -->
            <div class="privacy-section">
                <h3>11. Contact Us</h3>
                <p>If you have any questions, concerns, or requests regarding this Privacy Policy or your personal data,
                    please contact:</p>
                <p class="mt-2">
                    <strong>School Administration</strong><br>
                    Email: <a href="mailto:bagdadsarif@gmail.com">bagdadsarif@gmail.com</a><br>
                    Phone: +91 8250826434<br>
                    Address: <br>Chhoto Gadai khora, Poncharhat, <br>Sitalkuchi, Coochbehar West Bengal, 736158
                </p>
            </div>

            <!-- Consent -->
            <div class="privacy-section">
                <h3>12. Consent</h3>
                <p>By using the School Management System, you acknowledge that you have read and understood this Privacy
                    Policy and agree to the collection, use, and disclosure of your information as described herein.</p>
            </div>

            <!-- Back Button -->
            <div class="back-btn">
                <a class="btn btn-main rounded-pill px-24 py-12" href="<?= base_url() ?>" role="button">
                    Back to Home
                </a>
            </div>

        </div>
        <div class="dark-transparent sidebartoggler"></div>
    </div>

    <script>
    document.addEventListener('DOMContentLoaded', function() {

        console.log('[Capacitor] boot');

        if (!window.Capacitor) {
            console.warn('[Capacitor] Capacitor missing');
            return;
        }

        console.log('[Capacitor] version', window.Capacitor.getPlatform?.());

        const Plugins = window.Capacitor.Plugins || {};
        const App = Plugins.App;
        const Toast = Plugins.Toast;

        console.log('[Capacitor] Plugins available:', Object.keys(Plugins));

        if (!App) {
            console.error('[Capacitor] App plugin NOT available');
            return;
        }

        console.log('[Capacitor] App plugin OK');

        let lastBack = 0;

        App.addListener('backButton', () => {
            console.log('[Capacitor] HARDWARE BACK');

            if (window.history.length > 1) {
                window.history.back();
                return;
            }

            const now = Date.now();
            if (now - lastBack < 2000) {
                App.exitApp();
            } else {
                lastBack = now;
                Toast?.show({
                    text: 'Press back again to exit',
                    duration: 'short'
                });
            }
        });

    });
    </script>
</body>

</html>