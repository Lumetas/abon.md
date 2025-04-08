<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>abon.md - Markdown Knowledge Base</title>
    <link href="{{ asset('css/colorscheme.css') }}" rel="stylesheet">
    <link href="{{ asset('css/welcome.css') }}" rel="stylesheet">
</head>
<body>
    <div class="container">
        <header class="welcome-header">
            <div class="logo">abon.md</div>
            <h1 class="welcome-title">Your Personal Markdown Knowledge Base</h1>
            <p class="tagline">Inspired by Obsidian, built for the web</p>
        </header>
        
        <main class="welcome-content">
            <p class="welcome-text">Welcome to <strong>abon.md</strong>, a powerful yet simple Markdown-based knowledge management system that helps you organize your thoughts, notes, and ideas in a networked way.</p>
            
            <div class="features-container">
                <h2 class="features-title">Key Features:</h2>
                <div class="feature-item">Fully <strong>Markdown</strong> supported with syntax highlighting</div>
                <div class="feature-item"><strong>Full</strong> note synchronization</div>
            </div>
            
            <p class="welcome-text">Whether you're a developer, writer, researcher, or just someone who loves to take notes, abon.md adapts to your workflow with its flexible and intuitive interface.</p>
            
            <div class="cta-buttons">
                <a href="/register" class="btn btn-primary">Get Started</a>
                <a href="/login" class="btn btn-outline">Login</a>
            </div>
        </main>
    </div>
    
    <footer class="welcome-footer">
        &copy; {{ date('Y') }} abon.md | Markdown Knowledge Management System
    </footer>
</body>
</html>