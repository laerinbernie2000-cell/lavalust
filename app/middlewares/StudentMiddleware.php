<?php 
class StudentMiddleware
{
    public function handle(Closure $next)
    {
        if (!isset($_SESSION['student_access'])) {
            $_SESSION['student_notice'] = 'Access denied — please open the Student Home page first.';
            redirect('student');
            return;
        }

        return $next();
    }
}

