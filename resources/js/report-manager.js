// Report Management System (Frontend-only, using localStorage)
class ReportManager {
    constructor() {
        this.reportsKey = 'user_reports';
        this.chatMessagesKey = 'report_chat_messages';
    }

    // Generate a unique report ID
    generateReportId() {
        const timestamp = Date.now();
        const random = Math.random().toString(36).substr(2, 9);
        return `RPT-${new Date().getFullYear()}-${String(timestamp).slice(-6)}-${random.toUpperCase().slice(0, 3)}`;
    }

    // Get all reports for the current user
    getUserReports() {
        const reports = localStorage.getItem(this.reportsKey);
        if (!reports) return [];
        
        const allReports = JSON.parse(reports);
        const userEmail = this.getCurrentUserEmail();
        if (!userEmail) return [];
        
        // Filter reports by user email
        return allReports.filter(report => report.userEmail === userEmail);
    }

    // Get all reports (for employees)
    getAllReports() {
        const reports = localStorage.getItem(this.reportsKey);
        return reports ? JSON.parse(reports) : [];
    }

    // Get all public reports
    getPublicReports() {
        const allReports = this.getAllReports();
        return allReports.filter(report => report.isPublic === true);
    }

    // Get a specific report by ID
    getReportById(reportId) {
        const allReports = this.getAllReports();
        return allReports.find(report => report.id === reportId);
    }

    // Save a new report
    saveReport(reportData) {
        const reports = this.getAllReports();
        const userEmail = this.getCurrentUserEmail();
        
        const newReport = {
            id: this.generateReportId(),
            userEmail: userEmail,
            userName: this.getCurrentUserName(),
            ...reportData,
            status: 'Open',
            isPublic: false, // Default to private
            createdAt: new Date().toISOString(),
            updatedAt: new Date().toISOString()
        };

        reports.push(newReport);
        localStorage.setItem(this.reportsKey, JSON.stringify(reports));
        
        return newReport;
    }

    // Update a report
    updateReport(reportId, updates) {
        const reports = this.getAllReports();
        const index = reports.findIndex(r => r.id === reportId);
        
        if (index !== -1) {
            reports[index] = {
                ...reports[index],
                ...updates,
                updatedAt: new Date().toISOString()
            };
            localStorage.setItem(this.reportsKey, JSON.stringify(reports));
            return reports[index];
        }
        
        return null;
    }

    // Get current user email from session (we'll need to pass this from PHP)
    getCurrentUserEmail() {
        // This will be set by PHP via a data attribute or global variable
        return window.currentUserEmail || null;
    }

    // Get current user name
    getCurrentUserName() {
        return window.currentUserName || 'Anonymous';
    }

    // Chat Management
    getChatMessages(reportId) {
        const messages = localStorage.getItem(this.chatMessagesKey);
        if (!messages) return [];
        
        const allMessages = JSON.parse(messages);
        
        // Handle both array and object formats
        if (Array.isArray(allMessages)) {
            return allMessages.filter(msg => msg.reportId === reportId.toString());
        } else {
            // Object format: { reportId: [messages] }
            return allMessages[reportId] || allMessages[reportId.toString()] || [];
        }
    }

    saveChatMessage(reportId, messageText, senderType = 'user', attachments = []) {
        const allMessages = this.getAllChatMessages();
        const userEmail = this.getCurrentUserEmail();
        const userName = this.getCurrentUserName();
        
        const reportIdStr = reportId.toString();
        const newMessage = {
            id: Date.now() + Math.random(),
            reportId: reportIdStr,
            senderType: senderType, // 'user' or 'employee'
            senderEmail: userEmail,
            senderName: senderType === 'user' ? userName : 'Staff Member',
            message: messageText,
            attachments: attachments || [],
            timestamp: new Date().toISOString()
        };

        // Use object format for better organization
        if (!allMessages[reportIdStr]) {
            allMessages[reportIdStr] = [];
        }
        
        allMessages[reportIdStr].push(newMessage);
        localStorage.setItem(this.chatMessagesKey, JSON.stringify(allMessages));
        
        return newMessage;
    }

    getAllChatMessages() {
        const messages = localStorage.getItem(this.chatMessagesKey);
        if (!messages) return {};
        
        const parsed = JSON.parse(messages);
        
        // Convert array format to object format if needed
        if (Array.isArray(parsed)) {
            const messagesObj = {};
            parsed.forEach(msg => {
                const reportId = msg.reportId.toString();
                if (!messagesObj[reportId]) {
                    messagesObj[reportId] = [];
                }
                messagesObj[reportId].push(msg);
            });
            return messagesObj;
        }
        
        return parsed;
    }

    // Format date for display
    formatDate(dateString) {
        const date = new Date(dateString);
        const now = new Date();
        const diffMs = now - date;
        const diffMins = Math.floor(diffMs / 60000);
        const diffHours = Math.floor(diffMs / 3600000);
        const diffDays = Math.floor(diffMs / 86400000);

        if (diffMins < 1) return 'Just now';
        if (diffMins < 60) return `${diffMins} minute${diffMins > 1 ? 's' : ''} ago`;
        if (diffHours < 24) return `${diffHours} hour${diffHours > 1 ? 's' : ''} ago`;
        if (diffDays < 7) return `${diffDays} day${diffDays > 1 ? 's' : ''} ago`;
        
        return date.toLocaleDateString('en-US', { month: 'short', day: 'numeric', year: 'numeric' });
    }
}

// Export for use in other files
export default ReportManager;

// Also make it available globally for inline scripts
if (typeof window !== 'undefined') {
    window.ReportManager = ReportManager;
}

