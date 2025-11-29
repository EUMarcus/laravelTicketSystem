@extends('layouts.app')

@section('title', 'Terms of Service - Community Hub')

@section('content')
<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8" style="padding-top: 6rem !important; padding-bottom: 4rem;">
    <!-- Header -->
    <div class="text-center mb-12">
        <h1 class="text-4xl md:text-5xl font-bold text-gray-900 mb-4">Terms of Service</h1>
        <p class="text-lg text-gray-600">
            Last updated: {{ date('F d, Y') }}
        </p>
    </div>

    <!-- Content -->
    <div class="bg-white rounded-lg border border-gray-200 shadow-sm p-8 prose prose-lg max-w-none">
        <div class="space-y-8">
            <!-- Introduction -->
            <section>
                <h2 class="text-2xl font-bold text-gray-900 mb-4">1. Acceptance of Terms</h2>
                <p class="text-gray-700 leading-relaxed">
                    By accessing and using Community Hub ("the Platform"), you accept and agree to be bound by these Terms of Service. 
                    If you do not agree to these terms, please do not use our services. These terms apply to all users of the Platform, 
                    including visitors, registered users, and staff members.
                </p>
            </section>

            <!-- Description of Service -->
            <section>
                <h2 class="text-2xl font-bold text-gray-900 mb-4">2. Description of Service</h2>
                <p class="text-gray-700 leading-relaxed mb-4">
                    Community Hub is a digital platform that enables residents to:
                </p>
                <ul class="list-disc list-inside text-gray-700 space-y-2 ml-4">
                    <li>Submit reports and tickets for community issues</li>
                    <li>Share suggestions and ideas for community improvement</li>
                    <li>View and respond to community announcements</li>
                    <li>Engage with other community members</li>
                    <li>Access community resources and information</li>
                </ul>
            </section>

            <!-- User Accounts -->
            <section>
                <h2 class="text-2xl font-bold text-gray-900 mb-4">3. User Accounts</h2>
                <div class="space-y-4">
                    <div>
                        <h3 class="text-xl font-semibold text-gray-900 mb-2">3.1 Registration</h3>
                        <p class="text-gray-700 leading-relaxed">
                            To use certain features of the Platform, you must register for an account. You agree to:
                        </p>
                        <ul class="list-disc list-inside text-gray-700 space-y-2 ml-4 mt-2">
                            <li>Provide accurate, current, and complete information during registration</li>
                            <li>Maintain and update your information to keep it accurate</li>
                            <li>Maintain the security of your password and account</li>
                            <li>Accept responsibility for all activities under your account</li>
                            <li>Notify us immediately of any unauthorized use of your account</li>
                        </ul>
                    </div>
                    <div>
                        <h3 class="text-xl font-semibold text-gray-900 mb-2">3.2 Account Eligibility</h3>
                        <p class="text-gray-700 leading-relaxed">
                            You must be at least 18 years old to create an account. By registering, you represent and warrant that you meet this age requirement 
                            and have the legal capacity to enter into these terms.
                        </p>
                    </div>
                </div>
            </section>

            <!-- User Conduct -->
            <section>
                <h2 class="text-2xl font-bold text-gray-900 mb-4">4. User Conduct and Responsibilities</h2>
                <p class="text-gray-700 leading-relaxed mb-4">
                    You agree to use the Platform in a lawful and respectful manner. You are prohibited from:
                </p>
                <ul class="list-disc list-inside text-gray-700 space-y-2 ml-4">
                    <li>Posting false, misleading, or fraudulent information</li>
                    <li>Harassing, threatening, or abusing other users</li>
                    <li>Violating any applicable laws or regulations</li>
                    <li>Uploading malicious code, viruses, or harmful content</li>
                    <li>Impersonating any person or entity</li>
                    <li>Interfering with or disrupting the Platform's operation</li>
                    <li>Attempting to gain unauthorized access to the Platform or other users' accounts</li>
                    <li>Using the Platform for any commercial purpose without authorization</li>
                    <li>Collecting or harvesting information about other users</li>
                </ul>
            </section>

            <!-- Content and Intellectual Property -->
            <section>
                <h2 class="text-2xl font-bold text-gray-900 mb-4">5. Content and Intellectual Property</h2>
                <div class="space-y-4">
                    <div>
                        <h3 class="text-xl font-semibold text-gray-900 mb-2">5.1 Your Content</h3>
                        <p class="text-gray-700 leading-relaxed">
                            You retain ownership of content you submit to the Platform. By submitting content, you grant us a non-exclusive, 
                            worldwide, royalty-free license to use, display, and distribute your content for the purpose of operating and 
                            improving the Platform.
                        </p>
                    </div>
                    <div>
                        <h3 class="text-xl font-semibold text-gray-900 mb-2">5.2 Platform Content</h3>
                        <p class="text-gray-700 leading-relaxed">
                            All content on the Platform, including text, graphics, logos, and software, is the property of Community Hub or 
                            its licensors and is protected by copyright and other intellectual property laws.
                        </p>
                    </div>
                </div>
            </section>

            <!-- Privacy -->
            <section>
                <h2 class="text-2xl font-bold text-gray-900 mb-4">6. Privacy</h2>
                <p class="text-gray-700 leading-relaxed">
                    Your use of the Platform is also governed by our <a href="{{ route('privacy-policy') }}" class="text-[#65B741] hover:text-[#4d8a32] font-medium">Privacy Policy</a>. 
                    Please review our Privacy Policy to understand how we collect, use, and protect your information.
                </p>
            </section>

            <!-- Service Availability -->
            <section>
                <h2 class="text-2xl font-bold text-gray-900 mb-4">7. Service Availability</h2>
                <p class="text-gray-700 leading-relaxed">
                    We strive to provide continuous access to the Platform, but we do not guarantee uninterrupted or error-free service. 
                    We may temporarily suspend or restrict access for maintenance, updates, or other reasons. We are not liable for any 
                    loss or damage resulting from service interruptions.
                </p>
            </section>

            <!-- Limitation of Liability -->
            <section>
                <h2 class="text-2xl font-bold text-gray-900 mb-4">8. Limitation of Liability</h2>
                <p class="text-gray-700 leading-relaxed">
                    To the maximum extent permitted by law, Community Hub and its staff shall not be liable for any indirect, incidental, 
                    special, consequential, or punitive damages, or any loss of profits or revenues, whether incurred directly or indirectly, 
                    or any loss of data, use, goodwill, or other intangible losses resulting from your use of the Platform.
                </p>
            </section>

            <!-- Indemnification -->
            <section>
                <h2 class="text-2xl font-bold text-gray-900 mb-4">9. Indemnification</h2>
                <p class="text-gray-700 leading-relaxed">
                    You agree to indemnify and hold harmless Community Hub, its officers, employees, and agents from any claims, damages, 
                    losses, liabilities, and expenses (including legal fees) arising from your use of the Platform, violation of these terms, 
                    or infringement of any rights of another party.
                </p>
            </section>

            <!-- Termination -->
            <section>
                <h2 class="text-2xl font-bold text-gray-900 mb-4">10. Termination</h2>
                <p class="text-gray-700 leading-relaxed mb-4">
                    We reserve the right to suspend or terminate your account and access to the Platform at our sole discretion, without notice, 
                    for any reason, including but not limited to:
                </p>
                <ul class="list-disc list-inside text-gray-700 space-y-2 ml-4">
                    <li>Violation of these Terms of Service</li>
                    <li>Fraudulent or illegal activity</li>
                    <li>Misuse of the Platform</li>
                    <li>Extended period of account inactivity</li>
                </ul>
                <p class="text-gray-700 leading-relaxed mt-4">
                    You may also terminate your account at any time by contacting us or using the account deletion feature.
                </p>
            </section>

            <!-- Changes to Terms -->
            <section>
                <h2 class="text-2xl font-bold text-gray-900 mb-4">11. Changes to Terms</h2>
                <p class="text-gray-700 leading-relaxed">
                    We reserve the right to modify these Terms of Service at any time. We will notify users of significant changes by posting 
                    the updated terms on this page and updating the "Last updated" date. Your continued use of the Platform after changes 
                    constitutes acceptance of the modified terms.
                </p>
            </section>

            <!-- Governing Law -->
            <section>
                <h2 class="text-2xl font-bold text-gray-900 mb-4">12. Governing Law</h2>
                <p class="text-gray-700 leading-relaxed">
                    These Terms of Service shall be governed by and construed in accordance with the laws of the Philippines, without regard 
                    to its conflict of law provisions.
                </p>
            </section>

            <!-- Contact Information -->
            <section>
                <h2 class="text-2xl font-bold text-gray-900 mb-4">13. Contact Information</h2>
                <p class="text-gray-700 leading-relaxed mb-4">
                    If you have any questions about these Terms of Service, please contact us:
                </p>
                <div class="bg-gray-50 rounded-lg p-6">
                    <p class="text-gray-700"><strong>Email:</strong> info@communityhub.ph</p>
                    <p class="text-gray-700"><strong>Phone:</strong> (02) 123-4567</p>
                    <p class="text-gray-700"><strong>Address:</strong> Barangay Hall</p>
                    <p class="text-gray-700"><strong>Office Hours:</strong> Mon-Fri: 8:00 AM - 5:00 PM</p>
                </div>
            </section>
        </div>
    </div>

    <!-- Back to Home -->
    <div class="mt-8 text-center">
        <a href="{{ route('home') }}" class="inline-flex items-center px-6 py-3 bg-[#65B741] text-white font-semibold rounded-lg hover:bg-[#4d8a32] transition-colors">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
            </svg>
            Back to Home
        </a>
    </div>
</div>
@endsection

