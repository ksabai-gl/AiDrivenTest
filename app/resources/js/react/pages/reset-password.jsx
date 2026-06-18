import React, { useEffect } from 'react';
import AuthLayout from '../layouts/AuthLayout';
import { useNavigate, useRoutes, useSearchParams } from "react-router-dom";
import AuthencationService from "../services/AuthencationService";
import { usePopup } from '../components/popups/PopupContext'
export default function ResetPassword() {
     const navigate = useNavigate();
    const { openPopup } = usePopup();
    const [searchParams] = useSearchParams();
    useEffect(() => {
        AuthencationService.resetPassword({
            token: searchParams.get("token")
        }).then((data) => {
            openPopup({
                message: 'You has been reset password, please check inbox your mail to get password',
                type: 'success',
                onConfirm: () => {
                    navigate('/login')
                }
            })
        }).catch((error) => {
            if(error.response.data?.message) {
                openPopup({
                    message: error.response.data?.message,
                    type: 'error',
                    onConfirm: () => {
                        navigate('/login')
                    }
                })    
            }
        })
    }, [searchParams]);
    return <AuthLayout>
        <div className='auth-verify-box text-center'>
            <h1 className='theme-title'>Reset password account</h1>
            <p className='theme-title'>Please waiting for processing ....</p>
        </div>
    </AuthLayout>
}