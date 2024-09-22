<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: index.php");
    exit;
}

$username = $_SESSION['username'];
$name = $_SESSION['name'];
$id = $_SESSION['id'];
?>


<!DOCTYPE html>
<html lang="en" class="group" data-sidebar-size="lg" data-theme-mode="light">
 <head>
  <meta charset="utf-8">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <title>Dashboard</title>
  <meta name="robots" content="noindex, follow">
  <meta name="description" content="web development agency">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <!-- Favicon -->
  <link rel="shortcut icon" type="image/x-icon" href="assets/images/favicon.ico">
  <!-- Style CSS -->
   <!-- Style CSS -->
  <link rel="stylesheet" href="assets/css/vendor/prism.min.css">
  <link rel="stylesheet" href="assets/css/output.css">
</head>
<body class="bg-body-light dark:bg-dark-body">
    <div id="loader" class="w-screen h-screen flex-center bg-white dark:bg-dark-card fixed inset-0 z-[9999]">
        <img src="assets/images/dot-loader.gif" alt="loader">
    </div>
    <!-- Start Header -->
    <header class="header px-4 sm:px-6 h-[calc(theme('spacing.header')_-_10px)] sm:h-header bg-white dark:bg-dark-card rounded-none xl:rounded-15 flex items-center mb-4 xl:m-4 group-data-[sidebar-size=lg]:xl:ml-[calc(theme('spacing.app-menu')_+_32px)] group-data-[sidebar-size=sm]:xl:ml-[calc(theme('spacing.app-menu-sm')_+_32px)] ac-transition">
        <div class="flex-center-between grow">
            <!-- Header Left -->
            <div class="flex items-center gap-4">
                <div class="menu-hamburger-container flex-center">
                    <button type="button" id="app-menu-hamburger" class="menu-hamburger hidden xl:block"></button>
                    <button type="button" class="menu-hamburger block xl:hidden" data-drawer-target="app-menu-drawer" data-drawer-show="app-menu-drawer" aria-controls="app-menu-drawer"></button>
                </div>
                <div class="w-56 md:w-72 leading-none text-sm relative text-gray-900 dark:text-dark-text hidden sm:block">
                    <span class="absolute top-1/2 -translate-y-[40%] left-3.5">
                        <i class="ri-search-line text-gray-900 dark:text-dark-text text-[14px]"></i>
                    </span>
                    <input type="text" name="header-search" id="header-search" placeholder="Search..." class="bg-transparent pl-[36px] pr-12 py-4 dk-border-one rounded-full w-full font-spline_sans focus:outline-none focus:border-primary-500"> 
                    <span class="absolute top-1/2 -translate-y-[40%] right-4 hidden lg:flex lg:items-center lg:gap-0.5 select-none">
                        <i class="ri-command-line text-[12px]"></i><span>+</span><span>k</span>
                    </span>
                </div>
            </div>
            <!-- Header Right -->
            <div class="flex items-center gap-1 sm:gap-3">
                <!-- Dark Light Button -->
                <button type="button" class="themeMode size-8 flex-center hover:bg-gray-200 dark:hover:bg-gray-700 rounded-md" onclick="toggleThemeMode()">
                    <i class="ri-contrast-2-line text-[22px] dark:text-dark-text-two dark:before:!content-['\f1bf']"></i>
                </button>
                <!-- Settings Button -->
                <button type="button" class="size-8 flex-center hover:bg-gray-200 dark:hover:bg-gray-700 rounded-md" data-drawer-target="app-setting-drawer" data-drawer-show="app-setting-drawer" data-drawer-placement="right" aria-controls="app-setting-drawer">
                    <i class="ri-settings-3-line text-[22px] dark:text-dark-text-two animate-spin-slow"></i>
                </button>
                
                
                <!-- Border -->
                <div class="w-[1px] h-[calc(theme('spacing.header')_-_10px)] sm:h-header bg-[#EEE] dark:bg-dark-border hidden sm:block"></div>
                <!-- User Profile Button -->
                <div class="relative">
                    <button type="button" data-popover-target="dropdownProfile" data-popover-trigger="click" data-popover-placement="bottom-end" class="text-gray-500 dark:text-dark-text flex items-center gap-2 sm:pr-4 relative after:absolute after:right-0 after:font-remix after:content-['\ea4e'] after:text-[18px] after:hidden sm:after:block">
                        <img src="assets/images/user/profile-img.png" alt="user-img" class="size-7 sm:size-9 rounded-50">
                        
                    </button>
                    <!-- Dropdown menu -->
                    <div id="dropdownProfile" class="invisible z-backdrop bg-white text-left divide-y divide-gray-100 rounded-lg shadow w-48 dark:bg-dark-card-shade dark:divide-dark-border-four">
                        <div class="px-4 py-3 text-sm text-gray-500 dark:text-white">
                            <div class="font-medium "><?php echo htmlspecialchars($name); ?></div>
                        </div>
                        <ul class="py-2 text-sm text-gray-700 dark:text-gray-200">
                            <li>
                                <a href="dashboard.php" class="flex font-medium px-4 py-2 hover:bg-gray-200 dark:hover:bg-dark-icon dark:hover:text-white">Dashboard</a>
                            </li>
                            
                        </ul>
                        <div class="py-2">
                            <a href="logout.php" class="flex font-medium px-4 py-2 text-sm text-gray-700 hover:bg-gray-200 dark:hover:bg-dark-icon dark:text-gray-200 dark:hover:text-white">Sign out</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <!-- End Header -->

    <!-- Start App Menu -->
    <div id="app-menu-drawer" class="app-menu flex flex-col gap-y-2.5 bg-white dark:bg-dark-card w-app-menu fixed top-0 left-0 bottom-0 -translate-x-full group-data-[sidebar-size=sm]:min-h-screen group-data-[sidebar-size=sm]:h-max xl:translate-x-0 rounded-r-10 xl:rounded-15 xl:group-data-[sidebar-size=lg]:w-app-menu xl:group-data-[sidebar-size=sm]:w-app-menu-sm xl:group-data-[sidebar-size=sm]:absolute xl:group-data-[sidebar-size=lg]:fixed xl:top-4 xl:left-4 xl:group-data-[sidebar-size=lg]:bottom-4 z-backdrop ac-transition" tabindex="-1">
        <div class="px-4 h-header flex items-center shrink-0 group-data-[sidebar-size=sm]:px-2 group-data-[sidebar-size=sm]:justify-center">
            <a href="dashboard.php" class="group-data-[sidebar-size=lg]:block hidden">
                <img src="assets/images/logo/logo-text.svg" alt="logo" class="group-data-[theme-mode=dark]:hidden">
                <img src="assets/images/logo/logo-text-dark.svg" alt="logo" class="group-data-[theme-mode=light]:hidden">
            </a>
            <a href="dashboard.php" class="group-data-[sidebar-size=lg]:hidden block">
                <img src="assets/images/logo/logo-icon.svg" alt="logo">
            </a>
        </div>
        <div id="app-menu-scrollbar" data-scrollbar class="pl-4 group-data-[sidebar-size=sm]:pl-0 group-data-[sidebar-size=sm]:!overflow-visible !overflow-x-hidden smooth-scrollbar">
            <div class="group-data-[sidebar-size=lg]:max-h-full">
                <ul id="navbar-nav" class="text-[14px] !leading-none space-y-1 group-data-[sidebar-size=sm]:space-y-2.5 group-data-[sidebar-size=sm]:flex group-data-[sidebar-size=sm]:flex-col group-data-[sidebar-size=sm]:items-start group-data-[sidebar-size=sm]:mx-2 group-data-[sidebar-size=sm]:overflow-visible">
                    <li class="relative group/sm w-full group-data-[sidebar-size=sm]:hover:w-[calc(theme('spacing.app-menu-sm')_*_3.4)] group-data-[sidebar-size=sm]:flex-center">
                        <a href="#" class="dropdown-button top-layer relative text-gray-500 dark:text-dark-text-two font-medium leading-none px-3.5 py-3 h-[42px] flex items-center group/menu-link ac-transition peer/dp-btn group-data-[sidebar-size=sm]:bg-gray-100 dark:group-data-[sidebar-size=sm]:bg-dark-icon group-data-[sidebar-size=sm]:hover:bg-primary-500/95 group-data-[sidebar-size=sm]:[&.active]:bg-primary-500/95 hover:text-white [&.active]:text-white hover:!bg-primary-500/95 [&.active]:bg-primary-500/95 group-data-[sidebar-size=sm]:rounded-lg group-data-[sidebar-size=sm]:group-hover/sm:!rounded-br-none group-data-[sidebar-size=lg]:rounded-l-full group-data-[sidebar-size=sm]:p-3 group-data-[sidebar-size=sm]:w-full">
                            <span class="shrink-0 group-data-[sidebar-size=sm]:w-[calc(theme('spacing.app-menu-sm')_*_0.43)] group-data-[sidebar-size=sm]:flex-center">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none">
                                    <path d="M6.54548 3.63639C6.54548 4.21175 6.37486 4.77419 6.05521 5.25259C5.73555 5.73099 5.28121 6.10385 4.74965 6.32404C4.21808 6.54422 3.63316 6.60183 3.06885 6.48958C2.50454 6.37733 1.98619 6.10027 1.57935 5.69342C1.17251 5.28658 0.895441 4.76823 0.783194 4.20392C0.670946 3.63961 0.728555 3.05469 0.948738 2.52313C1.16892 1.99156 1.54179 1.53722 2.02018 1.21757C2.49858 0.897911 3.06102 0.727296 3.63639 0.727296C4.40793 0.727296 5.14786 1.03379 5.69342 1.57935C6.23898 2.12491 6.54548 2.86485 6.54548 3.63639ZM12.3637 6.54548C12.939 6.54548 13.5015 6.37486 13.9799 6.05521C14.4583 5.73555 14.8311 5.28121 15.0513 4.74965C15.2715 4.21808 15.3291 3.63316 15.2168 3.06885C15.1046 2.50454 14.8275 1.98619 14.4207 1.57935C14.0139 1.17251 13.4955 0.895441 12.9312 0.783194C12.3669 0.670946 11.782 0.728555 11.2504 0.948738C10.7188 1.16892 10.2645 1.54179 9.94484 2.02018C9.62518 2.49858 9.45457 3.06102 9.45457 3.63639C9.45457 4.40793 9.76106 5.14786 10.3066 5.69342C10.8522 6.23898 11.5921 6.54548 12.3637 6.54548ZM3.63639 9.45457C3.06102 9.45457 2.49858 9.62518 2.02018 9.94484C1.54179 10.2645 1.16892 10.7188 0.948738 11.2504C0.728555 11.782 0.670946 12.3669 0.783194 12.9312C0.895441 13.4955 1.17251 14.0139 1.57935 14.4207C1.98619 14.8275 2.50454 15.1046 3.06885 15.2168C3.63316 15.3291 4.21808 15.2715 4.74965 15.0513C5.28121 14.8311 5.73555 14.4583 6.05521 13.9799C6.37486 13.5015 6.54548 12.939 6.54548 12.3637C6.54548 11.5921 6.23898 10.8522 5.69342 10.3066C5.14786 9.76106 4.40793 9.45457 3.63639 9.45457ZM12.3637 9.45457C11.7883 9.45457 11.2259 9.62518 10.7475 9.94484C10.2691 10.2645 9.89619 10.7188 9.67601 11.2504C9.45582 11.782 9.39822 12.3669 9.51046 12.9312C9.62271 13.4955 9.89978 14.0139 10.3066 14.4207C10.7135 14.8275 11.2318 15.1046 11.7961 15.2168C12.3604 15.3291 12.9453 15.2715 13.4769 15.0513C14.0085 14.8311 14.4628 14.4583 14.7825 13.9799C15.1021 13.5015 15.2727 12.939 15.2727 12.3637C15.2727 11.5921 14.9663 10.8522 14.4207 10.3066C13.8751 9.76106 13.1352 9.45457 12.3637 9.45457Z" fill="#EEEEEE" class="group-hover/menu-link:fill-[url(#icon_gradient)] group-[.active]/menu-link:fill-[url(#icon_gradient)] dark:fill-none"/>
                                    <path d="M3.63636 1.61884e-06C2.91716 1.61884e-06 2.21411 0.21327 1.61611 0.612839C1.01811 1.01241 0.552031 1.58033 0.276803 2.24479C0.00157558 2.90925 -0.0704365 3.6404 0.0698733 4.34578C0.210183 5.05117 0.556513 5.69911 1.06507 6.20766C1.57362 6.71622 2.22156 7.06255 2.92695 7.20286C3.63233 7.34316 4.36348 7.27115 5.02794 6.99593C5.6924 6.7207 6.26032 6.25462 6.65989 5.65662C7.05946 5.05862 7.27273 4.35557 7.27273 3.63636C7.27273 2.67194 6.88961 1.74702 6.20766 1.06507C5.52571 0.383117 4.60079 1.61884e-06 3.63636 1.61884e-06ZM3.63636 5.81818C3.20484 5.81818 2.78301 5.69022 2.42421 5.45048C2.06541 5.21074 1.78576 4.86998 1.62063 4.47131C1.45549 4.07263 1.41228 3.63394 1.49647 3.21071C1.58066 2.78748 1.78845 2.39872 2.09359 2.09359C2.39872 1.78845 2.78748 1.58066 3.21071 1.49647C3.63394 1.41228 4.07263 1.45549 4.47131 1.62063C4.86998 1.78576 5.21074 2.06541 5.45048 2.42421C5.69022 2.78301 5.81818 3.20484 5.81818 3.63636C5.81818 4.21502 5.58831 4.76997 5.17914 5.17914C4.76997 5.58831 4.21502 5.81818 3.63636 5.81818ZM12.3636 7.27273C13.0828 7.27273 13.7859 7.05946 14.3839 6.65989C14.9819 6.26032 15.448 5.6924 15.7232 5.02794C15.9984 4.36348 16.0704 3.63233 15.9301 2.92695C15.7898 2.22156 15.4435 1.57362 14.9349 1.06507C14.4264 0.556513 13.7784 0.210183 13.0731 0.0698733C12.3677 -0.0704365 11.6365 0.00157558 10.9721 0.276803C10.3076 0.552031 9.73968 1.01811 9.34011 1.61611C8.94054 2.21411 8.72727 2.91716 8.72727 3.63636C8.72727 4.60079 9.11039 5.52571 9.79234 6.20766C10.4743 6.88961 11.3992 7.27273 12.3636 7.27273ZM12.3636 1.45455C12.7952 1.45455 13.217 1.58251 13.5758 1.82225C13.9346 2.06199 14.2142 2.40274 14.3794 2.80142C14.5445 3.20009 14.5877 3.63878 14.5035 4.06202C14.4193 4.48525 14.2115 4.87401 13.9064 5.17914C13.6013 5.48428 13.2125 5.69207 12.7893 5.77626C12.3661 5.86045 11.9274 5.81724 11.5287 5.6521C11.13 5.48696 10.7893 5.20732 10.5495 4.84852C10.3098 4.48972 10.1818 4.06789 10.1818 3.63636C10.1818 3.05771 10.4117 2.50276 10.8209 2.09359C11.23 1.68442 11.785 1.45455 12.3636 1.45455ZM3.63636 8.72727C2.91716 8.72727 2.21411 8.94054 1.61611 9.34011C1.01811 9.73968 0.552031 10.3076 0.276803 10.9721C0.00157558 11.6365 -0.0704365 12.3677 0.0698733 13.0731C0.210183 13.7784 0.556513 14.4264 1.06507 14.9349C1.57362 15.4435 2.22156 15.7898 2.92695 15.9301C3.63233 16.0704 4.36348 15.9984 5.02794 15.7232C5.6924 15.448 6.26032 14.9819 6.65989 14.3839C7.05946 13.7859 7.27273 13.0828 7.27273 12.3636C7.27273 11.3992 6.88961 10.4743 6.20766 9.79234C5.52571 9.11039 4.60079 8.72727 3.63636 8.72727ZM3.63636 14.5455C3.20484 14.5455 2.78301 14.4175 2.42421 14.1777C2.06541 13.938 1.78576 13.5973 1.62063 13.1986C1.45549 12.7999 1.41228 12.3612 1.49647 11.938C1.58066 11.5148 1.78845 11.126 2.09359 10.8209C2.39872 10.5157 2.78748 10.3079 3.21071 10.2237C3.63394 10.1396 4.07263 10.1828 4.47131 10.3479C4.86998 10.513 5.21074 10.7927 5.45048 11.1515C5.69022 11.5103 5.81818 11.9321 5.81818 12.3636C5.81818 12.9423 5.58831 13.4972 5.17914 13.9064C4.76997 14.3156 4.21502 14.5455 3.63636 14.5455ZM12.3636 8.72727C11.6444 8.72727 10.9414 8.94054 10.3434 9.34011C9.74538 9.73968 9.2793 10.3076 9.00407 10.9721C8.72884 11.6365 8.65683 12.3677 8.79714 13.0731C8.93745 13.7784 9.28378 14.4264 9.79234 14.9349C10.3009 15.4435 10.9488 15.7898 11.6542 15.9301C12.3596 16.0704 13.0908 15.9984 13.7552 15.7232C14.4197 15.448 14.9876 14.9819 15.3872 14.3839C15.7867 13.7859 16 13.0828 16 12.3636C16 11.3992 15.6169 10.4743 14.9349 9.79234C14.253 9.11039 13.3281 8.72727 12.3636 8.72727ZM12.3636 14.5455C11.9321 14.5455 11.5103 14.4175 11.1515 14.1777C10.7927 13.938 10.513 13.5973 10.3479 13.1986C10.1828 12.7999 10.1396 12.3612 10.2237 11.938C10.3079 11.5148 10.5157 11.126 10.8209 10.8209C11.126 10.5157 11.5148 10.3079 11.938 10.2237C12.3612 10.1396 12.7999 10.1828 13.1986 10.3479C13.5973 10.513 13.938 10.7927 14.1777 11.1515C14.4175 11.5103 14.5455 11.9321 14.5455 12.3636C14.5455 12.9423 14.3156 13.4972 13.9064 13.9064C13.4972 14.3156 12.9423 14.5455 12.3636 14.5455Z" fill="#999999" class="group-hover/menu-link:fill-white group-[.active]/menu-link:fill-white"/>
                                    <defs>
                                        <linearGradient id="icon_gradient" x1="2.18655" y1="3.46529" x2="8.18057" y2="12.9769" gradientUnits="userSpaceOnUse">
                                          <stop offset="0" stop-color="#795DED"/>
                                          <stop offset="0.0001" stop-color="#7D5DFE"/>
                                          <stop offset="1" stop-color="#76D466"/>
                                        </linearGradient>
                                    </defs>
                                </svg>
                            </span>
                            <span class="group-data-[sidebar-size=sm]:hidden group-data-[sidebar-size=sm]:ml-6 group-data-[sidebar-size=sm]:group-hover/sm:block ml-3 shrink-0">
                                Dashboard
                            </span>
                        </a>
                        <div class="dropdown-content transition-all duration-300 max-h-0 overflow-hidden hidden group-data-[sidebar-size=sm]:bg-white dark:group-data-[sidebar-size=sm]:bg-dark-tooltip group-data-[sidebar-size=sm]:!max-h-max group-data-[sidebar-size=sm]:overflow-visible group-data-[sidebar-size=lg]:block peer-[.show]/dp-btn:my-1.5 group-data-[sidebar-size=sm]:!my-0 group-data-[sidebar-size=lg]:w-[calc(theme('spacing.app-menu')_-_16px)] group-data-[sidebar-size=sm]:w-[calc(theme('spacing.app-menu-sm')_*_2.5)] group-data-[sidebar-size=sm]:absolute group-data-[sidebar-size=sm]:left-[calc(theme('spacing.app-menu-sm')_*_0.9)] top-full group-data-[sidebar-size=sm]:group-hover/sm:block group-data-[sidebar-size=sm]:shadow-menu-dropdown">
                            <ul class="text-[14px] pl-1.5 group-data-[sidebar-size=sm]:pl-0">
                                <li class="relative group/sub">
                                    <a href="dashboard.php" class="relative peer/link text-gray-500 dark:text-dark-text-two font-medium leading-none px-5 py-2.5 group-data-[sidebar-size=lg]:pl-8 flex hover:text-primary-500 dark:hover:text-dark-text [&.active]:text-primary-500 dark:[&.active]:text-dark-text before:absolute before:top-[49%] before:-translate-y-1/2 before:left-4 before:size-1.5 before:rounded-50 before:border before:border-gray-400 dark:before:border-text-dark hover:before:border-none hover:before:bg-primary-400 dark:hover:before:bg-text-dark [&.active]:before:border-none group-data-[sidebar-size=sm]:after:block group-data-[sidebar-size=sm]:after:right-3 [&.active]:before:bg-primary-400 dark:[&.active]:before:bg-text-dark group-data-[sidebar-size=sm]:before:hidden">
                                        Dashboard
                                    </a>
                                </li>
                                <li class="relative group/sub">
                                    <a href="distribution.php" class="relative peer/link text-gray-500 dark:text-dark-text-two font-medium leading-none px-5 py-2.5 group-data-[sidebar-size=lg]:pl-8 flex hover:text-primary-500 dark:hover:text-dark-text [&.active]:text-primary-500 dark:[&.active]:text-dark-text before:absolute before:top-[49%] before:-translate-y-1/2 before:left-4 before:size-1.5 before:rounded-50 before:border before:border-gray-400 dark:before:border-text-dark hover:before:border-none hover:before:bg-primary-400 dark:hover:before:bg-text-dark [&.active]:before:border-none group-data-[sidebar-size=sm]:after:block group-data-[sidebar-size=sm]:after:right-3 [&.active]:before:bg-primary-400 dark:[&.active]:before:bg-text-dark group-data-[sidebar-size=sm]:before:hidden">
                                        Distribution list
                                    </a>
                                </li>
                               
                            </ul>
                        </div>
                    </li>
                  </ul>
            </div>
        </div>
        <!-- Logout Link -->
        <div class="mt-auto px-7 py-6 group-data-[sidebar-size=sm]:px-2">
            <a href="#" class="flex-center-between text-gray-500 dark:text-dark-text font-semibold leading-none bg-gray-200 dark:bg-[#090927] dark:group-data-[sidebar-size=sm]:bg-dark-card-shade rounded-[10px] px-6 py-4 group-data-[sidebar-size=sm]:p-[12px_8px] group-data-[sidebar-size=sm]:justify-center">
                <span class="group-data-[sidebar-size=sm]:hidden block">Logout</span>
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none">
                    <path d="M6.66645 15.3328C6.66645 15.5096 6.59621 15.6792 6.47119 15.8042C6.34617 15.9292 6.17661 15.9995 5.9998 15.9995H1.33329C0.979679 15.9995 0.640552 15.859 0.390511 15.609C0.140471 15.3589 0 15.0198 0 14.6662V1.33329C0 0.979679 0.140471 0.640552 0.390511 0.390511C0.640552 0.140471 0.979679 0 1.33329 0H5.9998C6.17661 0 6.34617 0.0702357 6.47119 0.195256C6.59621 0.320276 6.66645 0.48984 6.66645 0.666645C6.66645 0.84345 6.59621 1.01301 6.47119 1.13803C6.34617 1.26305 6.17661 1.33329 5.9998 1.33329H1.33329V14.6662H5.9998C6.17661 14.6662 6.34617 14.7364 6.47119 14.8614C6.59621 14.9865 6.66645 15.156 6.66645 15.3328ZM15.8045 8.47139L12.4713 11.8046C12.378 11.898 12.2592 11.9615 12.1298 11.9873C12.0004 12.0131 11.8663 11.9999 11.7444 11.9494C11.6225 11.8989 11.5184 11.8133 11.4451 11.7036C11.3719 11.5939 11.3329 11.4649 11.333 11.333V8.66638H5.9998C5.823 8.66638 5.65343 8.59615 5.52841 8.47113C5.40339 8.34611 5.33316 8.17654 5.33316 7.99974C5.33316 7.82293 5.40339 7.65337 5.52841 7.52835C5.65343 7.40333 5.823 7.33309 5.9998 7.33309H11.333V4.66651C11.3329 4.53459 11.3719 4.4056 11.4451 4.29587C11.5184 4.18615 11.6225 4.10062 11.7444 4.05012C11.8663 3.99962 12.0004 3.98642 12.1298 4.01218C12.2592 4.03795 12.378 4.10152 12.4713 4.19486L15.8045 7.52809C15.8665 7.59 15.9156 7.66352 15.9492 7.74445C15.9827 7.82538 16 7.91213 16 7.99974C16 8.08735 15.9827 8.17409 15.9492 8.25502C15.9156 8.33595 15.8665 8.40948 15.8045 8.47139ZM14.3879 7.99974L12.6663 6.27563V9.72385L14.3879 7.99974Z" fill="currentColor"/>
                </svg>
            </a>
        </div>
    </div>
    <!-- End App Menu -->

    <!-- Start App Settings Sidebar -->
    <div id="app-setting-drawer" class="side-canvas font-spline_sans dark:bg-dark-card-two right-0 h-screen translate-x-full duration-300 overflow-y-auto w-80 sm:w-96" tabindex="-1">
        <button type="button" data-drawer-hide="app-setting-drawer" aria-controls="app-setting-drawer" class="size-8 flex-center hover:bg-gray-200 dark:hover:bg-dark-icon rounded-lg absolute top-2.5 right-2.5">
            <i class="ri-close-line text-gray-500 dark:text-dark-text"></i>
        </button>
        <div class="p-6 py-3 border-b border-gray-200 dark:border-dark-border-four">
            <h6 class="text-lg font-medium text-gray-500 dark:text-dark-text">Personalize Settings</h6>
            <p class="text-sm text-gray-500 dark:text-dark-text mt-1">
                Design your space exactly how you want it !
            </p>
        </div>
        <!-- Customizatin Options -->
        <div class="p-6 pt-3 divide-y divide-gray-200 dark:divide-dark-border-four space-y-10">
            <!-- Theme Mode -->
            <div class="pt-10 first:pt-0">
                <h6 class="card-title text-base font-medium">Theme Mode</h6>
                <div class="grid grid-cols-6 gap-4 mt-2">
                    <div class="col-span-2">
                        <label class="text-xs text-gray-500 dark:text-dark-text-two font-medium mb-1 inline-block" for="radioThemeLight">Light</label>
                        <label class="text-gray-500 dark:text-dark-text-two border border-gray-200 hover:border-input-border dark:border-dark-border dark:hover:border-dark-border-five rounded-md flex-center py-3 select-none cursor-pointer ring-2 ring-transparent group-data-[theme-mode=light]:ring-primary-500 leading-none" for="radioThemeLight">
                            <i class="ri-sun-line text-inherit text-2xl"></i>
                            <input name="radioThemeMode" type="radio" id="radioThemeLight" hidden checked onchange="toggleThemeMode()">
                        </label>
                    </div>
                    <div class="col-span-2">
                        <label class="text-xs text-gray-500 dark:text-dark-text-two font-medium mb-1 inline-block" for="radioThemeDark">Dark</label>
                        <label class="text-gray-500 dark:text-dark-text-two border border-gray-200 hover:border-input-border dark:border-dark-border dark:hover:border-dark-border-five rounded-md flex-center py-3 select-none cursor-pointer ring-2 ring-transparent group-data-[theme-mode=dark]:ring-primary-500 leading-none" for="radioThemeDark">
                            <i class="ri-moon-clear-line text-inherit text-2xl"></i>
                            <input name="radioThemeMode" type="radio" id="radioThemeDark" hidden onchange="toggleThemeMode()">
                        </label>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End App Settings Sidebar -->

    <!-- Start Main Content -->
    <div class="main-content group-data-[sidebar-size=lg]:xl:ml-[calc(theme('spacing.app-menu')_+_16px)] group-data-[sidebar-size=sm]:xl:ml-[calc(theme('spacing.app-menu-sm')_+_16px)] px-4 ac-transition">
        <div class="grid grid-cols-12 gap-x-4">
            <!-- Start Intro -->
            <div class="col-span-full 2xl:col-span-12 card p-0">
                <div class="grid grid-cols-12 px-5 sm:px-12 py-11 relative overflow-hidden h-full">
                    <div class="col-span-full md:col-span-7 self-center inline-flex flex-col 2xl:block">
                        <p class="!leading-none text-sm lg:text-base text-gray-900 dark:text-dark-text">
                            Today is <span class="today">Thursday, 25 Jul 2024</span>
                        </p>
                        <h1 class="text-4xl xl:text-[42px] leading-[1.23] font-semibold mt-3">
                            <span class="flex-center justify-start">
                                <span class="shrink-0">Welcome Back.</span>
                                <span class="select-none hidden md:inline-block animate-hand-wave origin-[70%_70%]">👋</span></br>
                            </span>
                            </hr>
                            <?php echo htmlspecialchars($name); ?>
                        </h1>
                        <a href="household.php" class="btn b-solid btn-primary-solid btn-lg mt-6">
                            <i class="ri-add-line text-inherit"></i>
                            Household Registration
                        </a>
                    </div>
                    <div class="col-span-full md:col-span-5 flex-col items-center justify-center 2xl:block hidden md:flex">
                        <img src="assets/images/loti/loti-admin-dashboard.svg" alt="online-workshop" class="group-data-[theme-mode=dark]:hidden">
                        <img src="assets/images/loti/loti-admin-dashboard-dark.svg" alt="online-workshop" class="group-data-[theme-mode=light]:hidden">
                    </div>
                    <!-- Graphicla Elements -->
                    <ul>
                        <li class="absolute -top-[30px] left-1/2 animate-spin-slow">
                            <img src="assets/images/element/graphical-element-1.svg" alt="element">
                        </li>
                        <li class="absolute -bottom-[24px] left-1/4 animate-spin-slow">
                            <img src="assets/images/element/graphical-element-2.svg" alt="element">
                        </li>
                    </ul>
                </div>
            </div>
            <!-- End Intro -->
            <!-- Start Short Progress Card -->
           
        
                </div>
                
                 <div class="card">
            <h2 class="card-title">10 Recent ITN Distribution Data</h2>
        </div>
        <div class="grid grid-cols-12">
            <!-- INITIALIZE CSS CLASS -->
            <div class="hidden">
                <div class="self-center md:col-span-6 md:place-self-end lg:col-span-full inline-block w-auto ml-2 dark:bg-dark-card-two dark:text-white align-middle"></div>
                <div class="hover:bg-primary-500 hover:text-white dark:bg-gray-800 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white"></div>
                <div class="text-slate-300 border-slate-300 dark:!bg-gray-400 dark:text-slate-300 bg-slate-200/50 first:rounded-l-lg last:rounded-r-lg"></div>
                <div class=" dark:bg-gray-700 dark:!rounded-none transition-all duration-150 ease-linear [&.selected]:bg-[#F2F4F9] dark:[&.selected]:bg-dark-icon"></div>
                <div class="group-[.bordered]:rounded-none group-[.bordered]:border group-[.bordered]:border-gray-200 dark:group-[.bordered]:border-dark-border"></div>
            </div>
            <!-- INITIALIZE CSS CLASS -->
            <div class="tablejs sr-only size-0"></div>
            
            <!-- HOUSEHOLD TABLE -->
            <div class="col-span-full">
                <div class="card p-0">
                    
                    <div class="p-6 space-y-4">
                        <table id="basicDataTable">
                            <thead>
                                <tr>
                                    <th class="bg-[#B2E8D9]">Date</th>
                                    <th class="bg-[#B2E8D9]">Household ID</th>
                                    <th class="bg-[#B2E8D9]">Head of Household Name</th>
                                     <th class="bg-[#B2E8D9]">Phone Number</th>
                                    <th class="bg-[#B2E8D9]">No # of Family Member</th>
                                    <th class="bg-[#B2E8D9]">ITN Assigned</th>
                                    
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200 dark:divide-dark-border">
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                              
                             
                            </tbody>
                        </table>
                    </div>
                    <!-- Prism Code -->
                    <div class="p-6 hidden">
                        <pre>
                            <code class="language-markup">
                                &lt;p>Sorry we can't show the huge data table&lt;/p>
                            </code>
                        </pre>
                    </div>
                    <!-- Prism Code -->
                </div>
            </div>
         
        </div>
        
            </div>
            
           
           
        </div>
    </div>
    <!-- End Main Content -->


   <script src="assets/js/vendor/jquery.min.js"></script>
    <script src="assets/js/vendor/flowbite.min.js"></script>
    <script src="assets/js/vendor/smooth-scrollbar/smooth-scrollbar.min.js"></script>
    <script src="assets/js/vendor/prism.min.js"></script>
    <!-- datatable -->
    <script src="assets/js/vendor/datatables/data-tables.min.js"></script>
    <script src="assets/js/vendor/datatables/data-tables.tailwindcss.min.js"></script>
    <script src="assets/js/vendor/datatables/datatables.buttons.min.js"></script>
    <script src="assets/js/vendor/datatables/datatables.init.js"></script>
    <!-- datatable -->
    <script src="assets/js/component/prism-custom.js"></script>
    <script src="assets/js/component/app-menu-bar.js"></script>
    <script src="assets/js/layout.js"></script>
    <script src="assets/js/main.js"></script>
</body>
</html>