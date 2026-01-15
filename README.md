# Student Residence Application System

A web-based system that allows students to apply for on-campus residences and track their application status, while administrators manage and review applications through an admin dashboard.

## Problem Statement
Student residence applications are often handled manually or through fragmented systems, making it difficult for students to track application outcomes and for administrators to manage large volumes of requests efficiently. This system digitises the application process and enforces a clear review workflow.

## Features
- Student registration and login
- Residence application submission
- Application status tracking (pending, accepted, rejected)
- Admin dashboard for reviewing applications
- Admin approval and rejection workflow
- Secure session-based authentication

## User Roles
- **Students**: Apply for residences and track application status
- **Administrators**: Review, accept, or reject applications

## Tech Stack
- Frontend: HTML, CSS, JavaScript
- Backend: PHP
- Database: MySQL
- Server: Apache (XAMPP)

## System Overview
The system uses PHP for server-side logic and session management. Student applications are stored in a MySQL database and linked to user accounts. Administrators access a protected dashboard to review applications and update their status, which students can view in real time after login.

## Database Design
Core tables include users, residences, and applications, with foreign key relationships used to associate students with their submitted applications.

## Screenshots
(Add screenshots of login, application form, admin dashboard, and status view)

## Future Improvements
- Residence capacity enforcement
- Email notifications for application decisions
- Role-based access control refinement
