<!DOCTYPE html>
<html lang="en" class="group" data-sidebar-size="lg" data-theme-mode="light">
 <head>
  <meta charset="utf-8">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <title>ITN Task- Login Page</title>
  <meta name="robots" content="noindex, follow">
  <meta name="description" content="web development agency">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <!-- Favicon -->
  <link rel="shortcut icon" type="image/x-icon" href="assets/images/favicon.ico">
  <!-- Style CSS -->
  <link rel="stylesheet" href="assets/css/output.css">
</head>
<body class="bg-body-light dark:bg-dark-body">
    <div id="loader" class="w-screen h-screen flex-center bg-white dark:bg-dark-card fixed inset-0 z-[9999]">
        <img src="assets/images/dot-loader.gif" alt="loader">
    </div>

    <!-- Start Main Content -->
    <div class="main-content m-4">
        <div class="grid grid-cols-12 gap-y-7 sm:gap-7 card px-4 sm:px-10 2xl:px-[70px] py-15 lg:items-center lg:min-h-[calc(100vh_-_32px)]">
            <!-- Start Overview Area -->
            <div class="col-span-full lg:col-span-6">
                <div class="flex flex-col items-center justify-center gap-10 text-center">
                    <div class="hidden sm:block">
                        <img src="assets/images/loti/loti-auth.svg" alt="loti" class="group-data-[theme-mode=dark]:hidden">
                        <img src="assets/images/loti/loti-auth-dark.svg" alt="loti" class="group-data-[theme-mode=light]:hidden">
                    </div>
                    <div>
                        <h3 class="text-xl md:text-[28px] leading-none font-semibold text-heading">
                            Welcome back!
                        </h3>
                        <p class="font-medium text-gray-500 dark:text-dark-text mt-4 px-[10%]">
                            ITN Pre-Test Task 
                        </p>
                    </div>
                </div>
            </div>
            <!-- End Overview Area -->

            <!-- Start Form Area -->
            <div class="col-span-full lg:col-span-6 w-full lg:max-w-[600px]">
                <div class="border border-form dark:border-dark-border p-5 md:p-10 rounded-20 md:rounded-30">
                    <h3 class="text-xl md:text-[28px] leading-none font-semibold text-heading">
                        Sign In
                    </h3>
                    <p class="font-medium text-gray-500 dark:text-dark-text mt-4">
                        Welcome Back! Log in to your account 
                    </p>
                         <!-- Login Form Button -->
                    <form id="loginForm" method="POST" action="authentication.php" class="leading-none mt-8">
                        
                        <div class="mb-2.5">
                            <label for="username" class="form-label">Email</label>
                            <input type="text" id="username" name="username" requiredrequired class="form-input px-4 py-3.5 rounded-lg">
                        </div>
                        <div class="mt-5">
                            <label for="password" class="form-label">Password</label>
                            <div class="relative">
                                <input type="password" id="password" name="password" required class="form-input px-4 py-3.5 rounded-lg">
                                
                                <label for="toggleInputType" class="size-8 rounded-md flex-center hover:bg-gray-200 dark:hover:bg-dark-icon foucs:bg-gray-200 dark:foucs:bg-dark-icon position-center left-[95%]">
                                    <input type="checkbox" id="toggleInputType" class="inputTypeToggle peer/it" hidden>
                                    <i class="ri-eye-off-line text-gray-500 dark:text-dark-text peer-checked/it:before:content-['\ecb5']"></i>
                                </label>
                            </div>
                        </div>
                       <br>
                        <!-- Submit Button -->
                        <input type="submit" value="Login" class="btn b-solid btn-primary-solid w-full">
                    </form>
                
                    <div class="text-gray-900 dark:text-dark-text font-medium leading-none mt-5">
                        Don’t have an account yet?
                        <a href="sign-up.html" class="text-primary-500 font-semibold">Sign Up</a>
                    </div>
                </div>
            </div>
            <!-- End Form Area -->
        </div>
    </div>
    <!-- End Main Content -->
<script>

document.getElementById('loginForm').addEventListener('submit', function(event) {
    const username = document.getElementById('username').value;
    const password = document.getElementById('password').value;

    if (username === "" || password === "") {
        event.preventDefault();
        document.getElementById('error-message').innerText = "All fields are required.";
    }
});
</script>

    <script src="assets/js/vendor/jquery.min.js"></script>
    <script src="assets/js/layout.js"></script>
    <script src="assets/js/main.js"></script>
</body>
</html>