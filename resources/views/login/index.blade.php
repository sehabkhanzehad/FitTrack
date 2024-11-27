<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <!-- Bootstrap 5 CSS CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Optional: Custom Styles -->
    <style>
        body {
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            background-color: #f8f9fa;
        }
        .form-container {
            background: #fff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            max-width: 400px;
            width: 100%;
        }
    </style>
</head>
<body>
    <div class="form-container">
        <h2 class="text-center mb-4">Login</h2>
      
            <div class="mb-3">
                <label for="email" class="form-label">Email address</label>
                <input type="email" class="form-control" name="email" id="email" placeholder="Enter your email">
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" name="password" id="password" placeholder="Enter your password">
            </div>
            <div class="d-flex justify-content-between align-items-center">
                <div class="form-check">
                    <input type="checkbox" class="form-check-input" id="rememberMe">
                    <label class="form-check-label" for="rememberMe">Remember me</label>
                </div>
                <a href="#" class="text-decoration-none">Forgot password?</a>
            </div>
            <button onclick="SubmitLogin()" class="btn btn-primary w-100 mt-3">Login</button>
      
        <p class="text-center mt-3 mb-0">
            Don't have an account? <a href="#" class="text-decoration-none">Sign up</a>
        </p>
    </div>

    <!-- Bootstrap 5 JS CDN (Optional) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
            async function SubmitLogin() {

                try{
                    let email=document.getElementById('email').value;
                    let password=document.getElementById('password').value;

                    if(email.length===0){
                        errorToast("Email is required");
                    }
                    else if(password.length===0){
                        errorToast("Password is required");
                    }
                    else{
                        debugger;
                        let PostBody = {
                            "email" : email,
                            "password" : password
                        }
                        alert(PostBody.password);
                       
                        let res = await axios.post(`/adminpanel/login-check`,PostBody);                      
                        alert(res)
                        // alert(res.data['msg']);
                      

                        
                        if(res.status===200 && res.data['msg']==='success'){
                        
                            // debugger; 
                            successToast(res.data['msg']);
                            //wait 2 second for display success message
                            
                            setTimeout(() => {
                                window.location.href =`/admindashboard`;                   
                            }, 2000);
                        }
                        else{
                            errorToast(res.data['msg']);
                        }
                    } 
                }catch(e){ 
                    alert(res.data['msg']);
                }

                        
                }
    </script>
</body>
</html>
