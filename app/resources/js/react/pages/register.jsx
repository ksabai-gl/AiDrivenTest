import React, { useState, useEffect, useCallback } from "react";
import GradientButton from "../components/UI/Buttons/GradientButton";
import AuthencationService from "../services/AuthencationService";
import AuthLayout from "../layouts/AuthLayout";
import { Link, useNavigate } from "react-router-dom";
import { usePopup } from '../components/popups/PopupContext';
import { useForm } from "../libraries/handleInput";
import { InputForm } from "../components/UI/Input/InputForm";
import { useI18n } from "../../i18n/useI18n"; // Importing the useI18n hook

export default function Register() {
  const { t } = useI18n(); // Getting the translation function
  const { openPopup } = usePopup();
  const navigate = useNavigate();
  const form = useForm();

  const submit = useCallback(async () => {
    form.setLoading(true);
    form.setFormErrors(null);
    AuthencationService.register(form.formData).then((data) => {
      openPopup({
        type: 'success',
        message: t("Your account has been created, please check your inbox to activate your account"),
        onConfirm: () => {
          navigate('/login');
        }
      });
      form.setLoading(false);
    }).catch((error) => {
      if (error.response.data?.errors) {
        form.setFormErrors(error.response.data?.errors);
      }
      if(error.response.data?.message) {
        openPopup({
          type: 'error',
          message: error.response.data?.message
        });
      }
      form.setLoading(false);
    });
  }, [form.formData, navigate, openPopup, t]);
  return (
    <AuthLayout>
      <div className="auth-page-card">
        <h2 className="auth-page-title theme-title h3">{t("Welcome Back")}</h2>
        <p className="auth-page-subtitle theme-title ">{t("Sign in to your account to continue")}</p>

        <div>
          <div className="mb-3">
            <InputForm 
              name="name"
              handleChange={form.handleChange}
              value={form.formData?.name} 
              errorMessage={form.formErrors?.name} 
              type="text" 
              placeholder={t("Your name")} />
          </div>
          <div className="mb-3">
            <InputForm 
              name="email"
              handleChange={form.handleChange}
              value={form.formData?.email} 
              errorMessage={form.formErrors?.email} 
              type="email" 
              placeholder={t("Your email")} />
          </div>
          <div className="mb-3 position-relative">
            <InputForm 
              name="password"
              handleChange={form.handleChange}
              value={form.formData?.password} 
              errorMessage={form.formErrors?.password} 
              type="password" 
              placeholder={t("Your password")} />
          </div>
          <div className="mb-3 position-relative">
            <InputForm 
              name="password_confirmation"
              handleChange={form.handleChange}
              value={form.formData?.password_confirmation} 
              errorMessage={form.formErrors?.password_confirmation}  
              type="password"
              placeholder={t("Confirm password")} />
          </div>

          <div className="d-flex justify-content-between align-items-center mb-3">
            <Link to="/forget-password" className="text-decoration-none text-primary">
            {t("Forget password")}?</Link>
          </div>

          <GradientButton loading={form.loading} width={'100%'} callback={submit} text={t("Signup")} />

          <div className="auth-page-footer-text">
            {t("Don’t have an account")}? <Link to="/login">{t("Sign In")}</Link>
          </div>
        </div>
      </div>
    </AuthLayout>
  );
}

