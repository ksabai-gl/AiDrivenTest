import React from "react";

export default function WarningButton({ label = "Warning Button", onClick,
  disabled = false, loading = false }) {
  return (
    <button 
    disabled={disabled || loading}
    className="erp-btn erp-btn-warning" onClick={onClick}>
      {label}
    </button>
  );
}
