# Resumix – Resume Builder with Secure Data Storage and Multimedia Customization

A web-based resume builder that simplifies resume creation with drag-and-drop functionality, QR code sharing, multimedia support, and secure data handling.


## Project Status

⏸️ **Paused – Will Continue Independently**

This project was originally created as a group project for Integrative Programming and Technologies II. While the initial framework was developed collaboratively, the project was left incomplete after the academic term ended due to limited contribution from other members.

I have decided to take ownership of the project and plan to continue its development on my own. The current version serves as a foundation, and future updates will be added as I complete the remaining features.

**Last Active:** May 2025  
**Status:** On hold until further development begins

## About The Project

Resumix is a smart, user-centric platform designed to make the resume-building process easier, faster, and more personalized. It allows users to create, manage, and share professional resumes with greater convenience and flexibility. From QR code resume sharing to customizable profiles and file restoration, Resumix puts users in full control of their professional presentation.


## Objectives

- Develop an interactive, web-based resume builder for easy resume creation and editing
- Implement QR Code Resume feature for quick digital access
- Integrate drag-and-drop layout editor for customized resume sections
- Ensure data privacy and security through encrypted storage and secure login
- Support multimedia enhancements like profile photos and portfolio links
- Ensure cross-platform responsiveness across all devices


## Key Features

### User Side

#### ✅ Completed Features

- **User Registration and Authentication** – Secure sign-up and login with encrypted password storage
- **Email Verification** – Verify accounts through email confirmation links
- **OTP Verification** – Additional security layer for sensitive operations
- **Change Password** – Update passwords anytime from account settings
- **Reset Password** – Secure password recovery via email
- **User Profile** – View and edit profile information
- **User Session Log** – View login history with timestamps
- **User Activity Log** – Track actions with time and date stamps

#### ⏳ Pending / Incomplete Features

- **Recommended Templates** – Template suggestions based on industry and work type *(not yet implemented)*
- **Multimedia Integration** – Upload profile pictures and embed portfolio links *(partially implemented)*
- **Drag-and-Drop Resume Builder** – Customize resume layout by rearranging sections *(not yet implemented)*
- **QR Code Generation** – Unique QR codes linking to online resumes *(not yet implemented)*
- **Download Options** – Export resumes as PDF or share via digital links *(not yet implemented)*
- **Resume Creation Flow** – Full process from answering questions to editing and finalizing resume *(not yet implemented)*


### Admin Side

- Admin Dashboard – Centralized management for users, templates, and settings
- Manage Resume Templates – Upload, update, or delete templates
- User Management – View, update, deactivate, or delete user accounts
- Admin Activity Log – Track admin actions with timestamps
- Admin Session Log – Monitor admin logins and activities


## XML Implementation

XML is used in Resumix to handle form structure and data storage for specific features:

- Add Industry Page – Forms generated from XML files
- Industry Categories Table – Data stored in industries.xml
- Automatic XML Regeneration – XML files updated after database changes


## Security Features

- OTP-based Password Recovery – One-time password sent to registered email
- Email Verification for Password Changes – Confirm identity before changing password
- Secure Password Validation – Enforce password strength requirements
- Role-Based Access Control – Admin, Super Admin, and User roles with different permissions
- Session and Activity Logging – Track login/logout and user actions


## Built With

- Frontend: HTML, CSS, JavaScript
- Backend: PHP
- Database: MySQL / MariaDB
- Design Tools: Wireframe, Figma
- Server: XAMPP / Apache


## Getting Started

To get a local copy up and running, follow these steps.

### Prerequisites

- XAMPP ([Download here](https://www.apachefriends.org/))
- Visual Studio Code ([Download here](https://code.visualstudio.com/))
- Web browser


## Installation

Step 1: Install and run XAMPP
Start Apache and MySQL in the XAMPP Control Panel.

Step 2: Create the database
Go to localhost/phpmyadmin and create a new database named **resumixdb**.

Step 3: Import the SQL file
In phpMyAdmin, select your database in the connect folder, click the Import tab, choose the SQL file, and click Go.

Step 4: Configure email settings
Update the PHPMailer settings in the Mail folder with your email credentials for OTP functionality.

Step 5: Move project files
Copy the project folder to C:\xampp\htdocs\

Step 6: Open in VSCode
Open Visual Studio Code, select File > Open Folder, and choose your project folder.


## Usage

### Access the System

| Page | Local URL |
|------|-----------|
| **Landing Page** | `http://localhost/Resumix/Resumix/Frontend/User/pages/UserLandingPage.php` |
| **Login** | `http://localhost/Resumix/Frontend/User/pages/login.php` |
| **Sign Up** | `http://localhost/Resumix/Frontend/User/pages/signup.php` |


### How to Use

1. Create an account and verify your email
2. Log in to access your dashboard
3. Select your industry and work type for template recommendations
4. Build your resume using the drag-and-drop editor
5. Add personal info, work history, education, skills, and summary
6. Choose a template and customize the design
7. Preview, download as PDF, or share via QR code
8. Track your session and activity logs for security

### Features

- Users – Create resumes, choose templates, share via QR code, download PDF
- Admins – Manage users, templates, industries, and job titles


## Disclaimer

This project was developed as an academic requirement, Pamantasan ng Lungsod ng Pasig. All content is for educational and demonstration purposes only.


## Acknowledgments

- Faculty of the College of Computer Studies for their guidance
- Pamantasan ng Lungsod ng Pasig for the opportunity


## Prepared By

**Lead Developer:** Bernardo, Kanzaki Ning O.

**Members:**
- Aro, Katrina Anne C.
- Villena, Eleazar A.

**May 2025**
