// Temporary User Management (Frontend-only, until Supabase integration)
// This creates a temporary user ID stored in browser localStorage

class TemporaryAuth {
    constructor() {
        this.userIdKey = 'suggestion_user_id';
        this.userNameKey = 'suggestion_user_name';
        this.votesKey = 'suggestion_votes';
        this.commentsKey = 'suggestion_comments';
    }

    // Get or create temporary user ID
    getUserId() {
        let userId = localStorage.getItem(this.userIdKey);
        if (!userId) {
            // Generate a unique ID
            userId = 'temp_' + Date.now() + '_' + Math.random().toString(36).substr(2, 9);
            localStorage.setItem(this.userIdKey, userId);
        }
        return userId;
    }

    // Get or set user name
    getUserName() {
        return localStorage.getItem(this.userNameKey) || 'Anonymous';
    }

    setUserName(name) {
        if (name && name.trim()) {
            localStorage.setItem(this.userNameKey, name.trim());
        }
    }

    // Check if user has voted on a suggestion
    hasVoted(suggestionId) {
        const votes = this.getVotes();
        return votes.includes(suggestionId.toString());
    }

    // Record a vote
    recordVote(suggestionId) {
        const votes = this.getVotes();
        if (!votes.includes(suggestionId.toString())) {
            votes.push(suggestionId.toString());
            localStorage.setItem(this.votesKey, JSON.stringify(votes));
            return true;
        }
        return false;
    }

    // Remove a vote
    removeVote(suggestionId) {
        const votes = this.getVotes();
        const index = votes.indexOf(suggestionId.toString());
        if (index > -1) {
            votes.splice(index, 1);
            localStorage.setItem(this.votesKey, JSON.stringify(votes));
            return true;
        }
        return false;
    }

    // Get all votes
    getVotes() {
        const votes = localStorage.getItem(this.votesKey);
        return votes ? JSON.parse(votes) : [];
    }

    // Save a comment
    saveComment(suggestionId, comment) {
        const comments = this.getComments();
        const commentData = {
            id: Date.now(),
            suggestionId: suggestionId.toString(),
            userId: this.getUserId(),
            userName: this.getUserName(),
            text: comment.text,
            anonymous: comment.anonymous || false,
            date: new Date().toISOString()
        };
        
        if (!comments[suggestionId]) {
            comments[suggestionId] = [];
        }
        comments[suggestionId].push(commentData);
        localStorage.setItem(this.commentsKey, JSON.stringify(comments));
        return commentData;
    }

    // Get comments for a suggestion
    getCommentsForSuggestion(suggestionId) {
        const comments = this.getAllComments();
        return comments[suggestionId] || [];
    }

    // Get all comments
    getAllComments() {
        const comments = localStorage.getItem(this.commentsKey);
        return comments ? JSON.parse(comments) : {};
    }
}

// Export for use in other files
window.TemporaryAuth = TemporaryAuth;

