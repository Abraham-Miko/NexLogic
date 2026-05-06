<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Course Content - NexLogic</title>
    <link href="https://fonts.googleapis.com/css2?family=JetBrains+Mono:wght@400;500;700&family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <style>
        :root {
            --bg-deep: #080e1a;
            --bg-panel: #0f172a;
            --bg-sidebar: #1e293b;
            --purple-neon: #a855f7;
            --purple-neon-dim: rgba(168, 85, 247, 0.15);
            --border-color: #334155;
            --text-main: #f8fafc;
            --text-dim: #94a3b8;
            --green: #10b981;
        }

        * { margin: 0; padding: 0; box-sizing: border-box; }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: var(--bg-deep);
            color: var(--text-main);
            height: 100vh;
            display: flex;
            flex-direction: column; /* Allows topbar to sit above the rest */
            overflow: hidden;
        }

        /* Hide scroll on official sidebar only for this page */
        .sidebar {
            overflow-y: hidden !important;
        }

        /* --- Main Layout --- */
        .main-wrapper {
            flex-grow: 1;
            display: flex;
            flex-direction: column;
            position: relative;
            overflow: hidden;
        }

        /* --- Topbar --- */
        .topbar {
            height: 64px;
            border-bottom: 1px solid var(--border-color);
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 24px;
            background-color: rgba(15, 23, 42, 0.6);
            backdrop-filter: blur(10px);
            z-index: 60;
            flex-shrink: 0;
        }
        .btn-keluar {
            display: flex;
            align-items: center;
            gap: 8px;
            color: var(--text-main);
            text-decoration: none;
            font-weight: 500;
            transition: color 0.2s;
        }
        .btn-keluar:hover { color: var(--purple-neon); }

        .top-right {
            display: flex;
            align-items: center;
            gap: 16px;
        }
        .exp-badge {
            border: 1px solid var(--border-color);
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 0.85rem;
            font-weight: 600;
            font-family: 'JetBrains Mono', monospace;
            background: rgba(255,255,255,0.03);
        }

        /* --- User Profile Dropdown (Dari NexLogic Asli) --- */
        .user-dropdown-btn {
            display: flex;
            align-items: center;
            gap: 8px;
            padding: 5px 14px 5px 6px;
            border-radius: 30px;
            background: rgba(124, 58, 237, 0.08);
            border: 1px solid rgba(99, 102, 241, 0.2);
            color: #94a3b8;
            font-size: 0.85rem;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.2s;
            height: 38px;
        }
        .user-dropdown-btn:hover {
            color: #fff;
            border-color: rgba(167, 139, 250, 0.5);
            background: rgba(124, 58, 237, 0.2);
            box-shadow: 0 0 15px rgba(124, 58, 237, 0.3);
        }
        .dropdown-menu {
            background: rgba(15, 23, 42, 0.85);
            backdrop-filter: blur(12px);
            border: 1px solid rgba(124, 58, 237, 0.4);
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.5), 0 0 20px rgba(124, 58, 237, 0.2), inset 0 0 10px rgba(124, 58, 237, 0.1);
            border-radius: 12px;
            padding: 8px;
            overflow: hidden;
            position: absolute;
            right: 0;
            top: 100%;
            margin-top: 8px;
            min-width: 200px;
            z-index: 100;
        }
        .dropdown-item {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 10px 14px;
            color: #94a3b8;
            font-size: 0.85rem;
            font-weight: 500;
            text-decoration: none;
            border-radius: 8px;
            transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1);
            cursor: pointer;
            width: 100%;
            background: transparent;
            border: none;
            text-align: left;
            font-family: inherit;
        }
        .dropdown-item svg {
            width: 18px;
            height: 18px;
            opacity: 0.7;
            transition: all 0.2s;
        }
        .dropdown-item-edit-profil:hover {
            color: #fff;
            background: rgba(124, 58, 237, 0.15);
            transform: translateX(4px);
            box-shadow: inset 3px 0 0 #a78bfa;
        }
        .dropdown-item-dashboard:hover {
            color: #fff;
            background: rgba(88, 237, 58, 0.15);
            transform: translateX(4px);
            box-shadow: inset 3px 0 0 #94fa8b;
        }
        .dropdown-item:hover svg {
            opacity: 1;
            color: #a78bfa;
            transform: scale(1.1);
        }
        .dropdown-item.danger:hover {
            background: rgba(248, 113, 113, 0.12);
            color: #fca5a5;
            box-shadow: inset 3px 0 0 #fca5a5;
        }
        .dropdown-item.danger:hover svg {
            color: #fca5a5;
        }
        .dropdown-divider {
            height: 1px;
            background: linear-gradient(90deg, transparent, rgba(124, 58, 237, 0.4), transparent);
            margin: 6px 0;
            border: none;
        }

        /* --- Floating Hamburger Button --- */
        .floating-hamburger {
            position: fixed;
            right: 0;
            top: 80px; /* Right below the topbar */
            background-color: var(--bg-panel);
            border: 1px solid var(--border-color);
            border-right: none;
            border-radius: 24px 0 0 24px;
            width: 48px;
            height: 48px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            z-index: 50;
            color: var(--text-dim);
            transition: all 0.2s;
            box-shadow: -4px 0 15px rgba(0,0,0,0.3);
        }
        .floating-hamburger:hover {
            color: var(--text-main);
            background-color: #1e293b;
        }

        /* --- Main Content Area --- */
        .content-area {
            flex-grow: 1;
            overflow-y: auto;
            padding: 40px;
            display: flex;
            justify-content: center;
        }
        
        .content-area::-webkit-scrollbar { width: 6px; }
        .content-area::-webkit-scrollbar-thumb { background: var(--border-color); border-radius: 4px; }

        .content-card {
            max-width: 1000px;
            width: 100%;
        }

        .content-title {
            font-size: 2rem;
            font-weight: 700;
            margin-bottom: 24px;
            color: #fff;
        }

        .quiz-box {
            padding: 0;
            background: none;
            border: none;
            box-shadow: none;
            backdrop-filter: none;
        }

        .quiz-box h2 {
            font-family: 'JetBrains Mono', monospace;
            font-size: 1.25rem;
            margin-bottom: 16px;
            color: #e2e8f0;
        }

        .quiz-box p {
            color: #cbd5e1;
            line-height: 1.7;
            margin-bottom: 20px;
            font-size: 0.95rem;
        }

        .code-block {
            background-color: #030712;
            padding: 16px 20px;
            border-radius: 8px;
            font-family: 'JetBrains Mono', monospace;
            font-size: 0.9rem;
            color: #34d399; /* Green text for code */
            margin-bottom: 24px;
            border: 1px solid rgba(255,255,255,0.05);
        }

        /* --- Bottom Bar --- */
        .bottom-bar {
            height: 64px;
            background-color: var(--bg-panel);
            border-top: 1px solid var(--border-color);
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 32px;
            flex-shrink: 0;
            z-index: 40;
        }

        .nav-btn {
            background: transparent;
            border: none;
            color: var(--text-main);
            font-size: 0.95rem;
            font-weight: 500;
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 8px;
            transition: color 0.2s;
        }
        .nav-btn:hover { color: var(--purple-neon); }
        .nav-btn svg { width: 18px; height: 18px; }

        .active-topic-indicator {
            font-size: 0.95rem;
            font-weight: 600;
            color: #fff;
            letter-spacing: 0.02em;
        }

        /* --- Right Sidebar (Daftar Puzzle) --- */
        .right-sidebar {
            width: 320px;
            background-color: var(--bg-panel);
            border-left: 1px solid var(--border-color);
            display: flex;
            flex-direction: column;
            transition: margin-right 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            z-index: 45;
            flex-shrink: 0;
        }

        .right-sidebar.closed {
            margin-right: -320px;
        }

        .right-sidebar-header {
            padding: 20px 24px;
            border-bottom: 1px solid var(--border-color);
            display: flex;
            align-items: center;
            justify-content: space-between;
        }
        .right-sidebar-header h3 {
            font-size: 1.1rem;
            font-weight: 600;
            color: #fff;
        }

        .accordion-container {
            overflow-y: auto;
            flex-grow: 1;
        }

        .accordion-container::-webkit-scrollbar { width: 4px; }
        .accordion-container::-webkit-scrollbar-thumb { background: #334155; border-radius: 4px; }

        .accordion-item {
            border-bottom: 1px solid rgba(255,255,255,0.05);
        }

        .accordion-header {
            padding: 16px 20px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            cursor: pointer;
            font-weight: 500;
            color: #e2e8f0;
            transition: background 0.2s;
        }
        .accordion-header:hover { background: rgba(255,255,255,0.03); }
        .accordion-header .title-wrap {
            display: flex;
            align-items: center;
            gap: 12px;
        }
        .accordion-header svg {
            width: 16px;
            height: 16px;
            color: var(--text-dim);
            transition: transform 0.2s;
        }
        .accordion-item.open .accordion-header svg.chevron {
            transform: rotate(180deg);
        }

        .accordion-body {
            display: none;
            padding: 0 0 16px 44px;
        }
        .accordion-item.open .accordion-body {
            display: block;
        }

        .topic-list {
            list-style: none;
            position: relative;
        }
        .topic-list::before {
            content: '';
            position: absolute;
            left: 11px;
            top: 8px;
            bottom: 8px;
            width: 1px;
            background: var(--border-color);
            z-index: 1;
        }

        .topic-item {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 8px 0;
            color: var(--text-dim);
            font-size: 0.85rem;
            cursor: pointer;
            transition: color 0.2s;
            position: relative;
            z-index: 2;
        }
        .topic-item:hover { color: #fff; }
        .topic-item.active { color: var(--purple-neon); font-weight: 600; }

        .topic-circle {
            width: 24px;
            height: 24px;
            border-radius: 50%;
            background: var(--bg-panel);
            border: 1px solid var(--border-color);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.65rem;
            font-weight: 600;
        }
        .topic-item.active .topic-circle {
            border-color: var(--purple-neon);
            color: var(--purple-neon);
            box-shadow: 0 0 8px rgba(168, 85, 247, 0.3);
        }

        /* Mobile Responsive */
        @media (max-width: 768px) {
            .mcq-grid { grid-template-columns: 1fr; }
            .bottom-bar { padding: 0 16px; }
            .right-sidebar { position: absolute; right: 0; top: 0; bottom: 0; z-index: 60; }
        }
    </style>
</head>
<body x-data="courseData()">

    <!-- Topbar (Full Width) -->
    <header class="topbar">
        <a href="{{ route('courses') }}" class="btn-keluar" style="margin-left: 1rem;">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
            </svg>
            Keluar
        </a>
        
        <div class="top-right">
            <span class="exp-badge">0 EXP</span>
            
            @auth
                <div x-data="{ openProfile: false }" style="position: relative;">
                    <button @click="openProfile = !openProfile" class="user-dropdown-btn">
                        <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->nama) }}&background=7c3aed&color=fff&rounded=true&length=1"
                             alt="Profil"
                             style="width: 26px; height: 26px; border-radius: 50%; object-fit: cover; flex-shrink: 0;">

                        <span>{{ explode(' ', trim(Auth::user()->nama))[0] }}</span>

                        <svg xmlns="http://www.w3.org/2000/svg" style="width: 16px; height: 16px; flex-shrink: 0;" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                        </svg>
                    </button>

                    <div x-show="openProfile" @click.outside="openProfile = false"
                         x-transition:enter="transition ease-out duration-150"
                         x-transition:enter-start="opacity-0 translate-y-[-10px] scale-95"
                         x-transition:enter-end="opacity-100 translate-y-0 scale-100"
                         x-transition:leave="transition ease-in duration-100"
                         x-transition:leave-start="opacity-100 translate-y-0 scale-100"
                         x-transition:leave-end="opacity-0 translate-y-[-10px] scale-95"
                         class="dropdown-menu">

                        <a href="{{ route('profile.edit') }}" class="dropdown-item dropdown-item-edit-profil">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                            Edit Profil
                        </a>

                        <hr class="dropdown-divider">

                        <a href="{{ route('dashboard') }}" class="dropdown-item dropdown-item-dashboard">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                                <rect x="3" y="3" width="7" height="7" rx="1.5" stroke-linecap="round"/>
                                <rect x="14" y="3" width="7" height="7" rx="1.5" stroke-linecap="round"/>
                                <rect x="3" y="14" width="7" height="7" rx="1.5" stroke-linecap="round"/>
                                <rect x="14" y="14" width="7" height="7" rx="1.5" stroke-linecap="round"/>
                            </svg>
                            Dashboard
                        </a>

                        <hr class="dropdown-divider">

                        <form method="POST" action="{{ route('logout') }}" style="margin: 0;">
                            @csrf
                            <button type="submit" class="dropdown-item danger">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                                </svg>
                                Log Out
                            </button>
                        </form>
                    </div>
                </div>
            @endauth
        </div>
    </header>

    <!-- Main Container Layout -->
    <div style="display: flex; flex-grow: 1; overflow: hidden; width: 100%;">
        
        <!-- Left Official Sidebar -->
        @include('layouts.side_navigation')

        <!-- Main Wrapper -->
        <div class="main-wrapper">
            <!-- Content Area -->
            <main class="content-area">
                <div class="content-card">
                    
                    <h1 class="content-title" x-text="activeTopicName">Lorem ipsum</h1>
                    
                    <div class="quiz-box">
                        <h2>Soal <span x-text="currentStep">1</span></h2>
                        
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
                        
                        <p style="font-size: 0.8rem; color: #64748b; margin-bottom: 12px;">Lorem ipsum dolor sit amet</p>
                        
                        <div class="code-block">
                            print("Hello, World!")
                        </div>
                        
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit</p>
                </div>
            </main>

            <!-- Bottom Bar -->
            <footer class="bottom-bar">
                <button class="nav-btn" @click="prevStep">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
                    </svg>
                    Previous
                </button>
                
                <div class="active-topic-indicator">
                    <span x-text="activeTopicName">Variabel & Tipe Data</span>
                </div>
                
                <button class="nav-btn" @click="nextStep">
                    Next
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                    </svg>
                </button>
            </footer>
        </div>

        <!-- Right Sidebar (Daftar Puzzle) -->
        <aside class="right-sidebar" :class="{ 'closed': !rightSidebarOpen }">
            <div class="right-sidebar-header">
                <h3>Daftar Puzzle</h3>
                <button @click="toggleRightSidebar" style="background:none; border:none; color:var(--text-dim); cursor:pointer;">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
            
            <div class="accordion-container">
                <!-- Section 1 -->
                <div class="accordion-item" :class="{ 'open': openSection === 1 }">
                    <div class="accordion-header" @click="openSection = openSection === 1 ? null : 1">
                        <div class="title-wrap">
                            <svg class="chevron" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                            </svg>
                            Variabel & Tipe Data
                        </div>
                    </div>
                    <div class="accordion-body">
                        <ul class="topic-list">
                            <template x-for="i in 5" :key="i">
                                <li class="topic-item" :class="{ 'active': currentStep === i }" @click="selectStep(i, 'Mengenal Variabel ' + i)">
                                    <div class="topic-circle" x-text="i"></div>
                                    <span x-text="'Mengenal Variabel ' + i"></span>
                                </li>
                            </template>
                        </ul>
                    </div>
                </div>

                <!-- Section 2 (Locked) -->
                <div class="accordion-item" style="opacity: 0.5;">
                    <div class="accordion-header" style="cursor: not-allowed;">
                        <div class="title-wrap">
                            <svg class="chevron" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                            </svg>
                            Operator & Ekspresi
                        </div>
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd" />
                        </svg>
                    </div>
                </div>

                <!-- Section 3 (Locked) -->
                <div class="accordion-item" style="opacity: 0.5;">
                    <div class="accordion-header" style="cursor: not-allowed;">
                        <div class="title-wrap">
                            <svg class="chevron" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                            </svg>
                            Input & Output
                        </div>
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd" />
                        </svg>
                    </div>
                </div>

            </div>
        </aside>
    </div>
    
    <!-- Floating Hamburger Icon (Tampil saat Right Sidebar ditutup) -->
    <button class="floating-hamburger" @click="toggleRightSidebar" x-show="!rightSidebarOpen" x-transition>
        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 6.75h12M8.25 12h12m-12 5.25h12M3.75 6.75h.007v.008H3.75V6.75Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0ZM3.75 12h.007v.008H3.75V12Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm-.375 5.25h.007v.008H3.75v-.008Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z" />
        </svg>
    </button>

    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('courseData', () => ({
                sidebarOpen: false, // Untuk Left Sidebar (Official NexLogic)
                rightSidebarOpen: true, // Untuk Right Sidebar (Daftar Puzzle)
                openSection: 1,
                currentStep: 1,
                activeTopicName: 'Mengenal Variabel 1',
                selectedOption: null,

                toggleRightSidebar() {
                    this.rightSidebarOpen = !this.rightSidebarOpen;
                },
                
                selectStep(step, name) {
                    this.currentStep = step;
                    this.activeTopicName = name;
                    this.selectedOption = null;
                },

                nextStep() {
                    if (this.currentStep < 5) {
                        this.currentStep++;
                        this.activeTopicName = 'Mengenal Variabel ' + this.currentStep;
                        this.selectedOption = null;
                    }
                },

                prevStep() {
                    if (this.currentStep > 1) {
                        this.currentStep--;
                        this.activeTopicName = 'Mengenal Variabel ' + this.currentStep;
                        this.selectedOption = null;
                    }
                }
            }))
        })
    </script>
</body>
</html>
