import React from "react";
import { Plus } from "react-bootstrap-icons";

export default function IconButton({
  color = "#6366f1",
  size = 20,
  iconColor = "#000",
  icon: Icon = Plus,
  onClick,
}) {
  return (
    <button
      onClick={onClick}
      className="border-0 d-flex align-items-center justify-content-center"
      style={{
        width: size + 28,
        height: size+ 28,
        backgroundColor: color,
        borderRadius: 12,
        cursor: "pointer",
        transition: "all 0.2s ease-in-out",
        boxShadow: "0 3px 10px rgba(0,0,0,0.2)",
      }}
      onMouseOver={(e) => (e.currentTarget.style.opacity = 0.9)}
      onMouseOut={(e) => (e.currentTarget.style.opacity = 1)}
    >
      <Icon size={size} color={iconColor} />
    </button>
  );
}
