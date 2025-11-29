# Barangay Community Hub - Transformation Guide

## Overview
This document tracks the transformation of the Laravel Ticket System into a comprehensive Barangay Community Hub platform.

## ✅ Completed

### 1. Database Migrations
- ✅ Updated `profiles` table: Added address, contact_number, email, is_verified fields
- ✅ Updated `tickets` table: Added category, location, map_link, is_anonymous, contact_number; renamed subject to title
- ✅ Created `suggestions` table: For community suggestions with upvotes
- ✅ Created `announcements` table: For barangay announcements
- ✅ Created `polls` table: For voting/polling system
- ✅ Created `poll_votes` table: To track individual votes
- ✅ Created `events` table: For community calendar events
- ✅ Created `faqs` table: For frequently asked questions
- ✅ Created `suggestion_upvotes` table: To track suggestion upvotes

### 2. Models Created
- ✅ Suggestion
- ✅ Announcement
- ✅ Poll
- ✅ PollVote
- ✅ Event
- ✅ Faq
- ✅ SuggestionUpvote

### 3. UI Updates
- ✅ Updated navigation to include all new modules
- ✅ Changed branding from "Kampay Tickets" to "Barangay Community Hub"

## 🔄 In Progress

### Models (Need Relationships & Fillable)
- [ ] Update Suggestion model with relationships
- [ ] Update Announcement model with relationships
- [ ] Update Poll model with relationships
- [ ] Update Event model
- [ ] Update Faq model
- [ ] Update Profile model for new fields
- [ ] Update Ticket model (rename to Report) for new fields

### Controllers (Need Creation)
- [ ] DashboardController (home page with stats)
- [ ] ReportController (rename from TicketController, update for new fields)
- [ ] SuggestionController
- [ ] AnnouncementController
- [ ] PollController
- [ ] EventController
- [ ] FaqController

### Routes (Need Update)
- [ ] Update routes/web.php with all new routes
- [ ] Add resource routes for all modules
- [ ] Add upvote routes for suggestions
- [ ] Add vote routes for polls

### Views (Need Creation)
- [ ] Dashboard/home page with stats and quick actions
- [ ] Reports index (updated from tickets)
- [ ] Reports create/edit (with new fields: category, location, anonymous)
- [ ] Suggestions index
- [ ] Suggestions create/show
- [ ] Announcements index
- [ ] Announcements create/show (staff only)
- [ ] Polls index
- [ ] Polls create/show/vote
- [ ] Events calendar/list view
- [ ] Events create/show (staff only)
- [ ] FAQ accordion/list view
- [ ] FAQ create/edit (staff only)

## 📋 Feature Requirements

### Report & Ticket System
- [x] Database structure updated
- [ ] Add report categories (road issues, flooding, streetlights, garbage, noise, safety, lost & found, stray animals, other)
- [ ] Add location field with optional map link
- [ ] Add anonymous option
- [ ] Update status values: Open, Under Review, In Progress, Completed, Closed
- [ ] Update priority values: Low, Normal, High
- [ ] Staff can filter by category, status, date, search
- [ ] Staff can edit/delete reports

### Community Suggestion Board
- [x] Database structure created
- [ ] Create suggestion form with categories
- [ ] Implement upvote functionality
- [ ] Sort by: Newest, Most Liked, Most Discussed
- [ ] Show comment count (if comments implemented)
- [ ] Anonymous option

### Barangay Announcement Board
- [x] Database structure created
- [ ] Staff can create/edit/delete announcements
- [ ] Categories: Festival, Disaster, Health, Meeting, Schedule, Recap
- [ ] Image upload support
- [ ] Public feed view

### Voting / Polling System
- [x] Database structure created
- [ ] Staff can create polls with multiple options
- [ ] Set voting deadline
- [ ] One vote per resident per poll
- [ ] Show results as percentages
- [ ] View results after voting or when poll ends

### Community Calendar
- [x] Database structure created
- [ ] Monthly calendar view OR list view grouped by month
- [ ] Event details: title, date, time, location, description
- [ ] Categories: Festival, Meeting, Medical, Cleanup, Education, Sports
- [ ] Staff can create/edit/delete events

### FAQ System
- [x] Database structure created
- [ ] Accordion or list view
- [ ] Categories: Documents, Reporting, Events, General
- [ ] Staff can add/edit/remove FAQs
- [ ] Ordering support

### Resident Profile
- [x] Database structure updated
- [ ] Show name, address, contact, email
- [ ] Verified badge display
- [ ] List of their reports
- [ ] List of their suggestions
- [ ] Staff can edit profiles

### Search & Filter
- [ ] Global search functionality
- [ ] Per-module search (reports, suggestions, announcements, events)
- [ ] Filter by category, status, date range

## 🎨 UI/UX Requirements

### Navigation
- ✅ Updated to include: Dashboard, Reports, Suggestions, Announcements, Events, Polls, FAQ

### Color Scheme
- Primary: #007E6E (Teal)
- Secondary: #E7DEAF (Cream)
- Accent: #D7C097 (Beige)
- Success: #73AF6F (Green)
- Font: Manrope

### Components Needed
- [ ] Status badges (colored)
- [ ] Priority badges
- [ ] Category tags
- [ ] Upvote button component
- [ ] Poll voting component
- [ ] Calendar component
- [ ] FAQ accordion component
- [ ] Filter/search bar component

## 🚀 Next Steps

1. **Update Models** - Add relationships and fillable fields
2. **Create Controllers** - Implement CRUD operations
3. **Update Routes** - Add all new routes
4. **Create Views** - Build all UI pages
5. **Implement Features** - Upvotes, voting, search, filters
6. **Testing** - Test all functionality
7. **Documentation** - Update README with new features

## 📝 Notes

- The system maintains the existing authentication system
- Roles: resident (customer), staff (employee), admin
- File uploads continue to use Supabase Storage
- All new features should follow the existing design system

