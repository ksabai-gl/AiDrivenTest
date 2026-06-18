import React from "react";
import DashboardLayout from "../layouts/DashboardLayout";
import CommonDataTable from "../components/CommonDataTable";
import { formatMoney } from "../libraries/common";
import {
  LineChart,
  Line,
  XAxis,
  YAxis,
  Tooltip,
  ResponsiveContainer,
  CartesianGrid,
  Legend,
} from "recharts";

export default function Report() {
  // 🔹 Tổng hợp dữ liệu
  const summary = {
    totalRevenue: 125000000,
    totalExpense: 98000000,
    netProfit: 27000000,
    totalInvoices: 42,
    topProduct: { name: "Quạt mini 2 chiều", quantity: 120 },
    topCustomer: { name: "Nguyễn Văn A", total: 18000000 },
  };

  // 🔹 Dữ liệu biểu đồ doanh thu - chi phí theo tháng
  const chartData = [
    { month: "Tháng 1", revenue: 85000000, expense: 62000000 },
    { month: "Tháng 2", revenue: 95000000, expense: 70000000 },
    { month: "Tháng 3", revenue: 110000000, expense: 83000000 },
    { month: "Tháng 4", revenue: 104000000, expense: 78000000 },
    { month: "Tháng 5", revenue: 125000000, expense: 98000000 },
  ];

  // 🔹 Dữ liệu bảng chi tiết báo cáo (thay bằng CommonDataTable)
  const columns = [
    { label: "Danh mục", key: "category" },
    {
      label: "Giá trị",
      key: "value",
      render: (value) => (
        <span className="fw-bold text-info">
          {typeof value === "number" ? formatMoney(value) : value}
        </span>
      ),
    },
    { label: "Ghi chú", key: "description" },
  ];

  const data = [
    { category: "Tổng hóa đơn xuất", value: 25, description: "Đã hoàn thành" },
    { category: "Tổng hóa đơn nhập", value: 17, description: "Đã thanh toán" },
    { category: "Sản phẩm tồn kho", value: 342, description: "Số lượng hiện có" },
    { category: "Khách hàng mới", value: 8, description: "Trong tháng này" },
    {
      category: "Tỷ lệ hoàn thành đơn hàng",
      value: "92%",
      description: "Tính theo tổng số hóa đơn",
    },
  ];

  // 🔹 Không cần edit/delete trong report
  const handleEdit = () => {};
  const handleDelete = () => {};

  return (
    <DashboardLayout>
      <div className="m-4">
        {/* Header */}
        <div className="d-flex justify-content-between align-items-center mb-4">
          <div>
            <h5 className="fw-bold mb-2 theme-title">Báo cáo tổng hợp hệ thống</h5>
            <p className="theme-title mb-0">
              Tổng quan tình hình kinh doanh, doanh thu và chi phí
            </p>
          </div>
        </div>

        {/* Tổng quan KPI */}
        <div className="row g-3 mb-4">
          <div className="col-md-3">
            <div className="card bg-dark text-white p-3 border-0 shadow-sm">
              <h6 className="text-secondary">Tổng doanh thu</h6>
              <h4 className="fw-bold mt-2 text-success">
                {formatMoney(summary.totalRevenue)}
              </h4>
            </div>
          </div>
          <div className="col-md-3">
            <div className="card bg-dark text-white p-3 border-0 shadow-sm">
              <h6 className="text-secondary">Tổng chi phí</h6>
              <h4 className="fw-bold mt-2 text-danger">
                {formatMoney(summary.totalExpense)}
              </h4>
            </div>
          </div>
          <div className="col-md-3">
            <div className="card bg-dark text-white p-3 border-0 shadow-sm">
              <h6 className="text-secondary">Lợi nhuận ròng</h6>
              <h4
                className={`fw-bold mt-2 ${
                  summary.netProfit >= 0 ? "text-success" : "text-danger"
                }`}
              >
                {formatMoney(summary.netProfit)}
              </h4>
            </div>
          </div>
          <div className="col-md-3">
            <div className="card bg-dark text-white p-3 border-0 shadow-sm">
              <h6 className="text-secondary">Tổng số hóa đơn</h6>
              <h4 className="fw-bold mt-2 text-info">{summary.totalInvoices}</h4>
            </div>
          </div>
        </div>

        {/* Biểu đồ doanh thu - chi phí */}
        <div className="card bg-dark text-white border-0 rounded-3 p-4 mb-4">
          <h6 className="fw-bold mb-3">Biểu đồ doanh thu & chi phí theo tháng</h6>
          <ResponsiveContainer width="100%" height={300}>
            <LineChart data={chartData}>
              <CartesianGrid strokeDasharray="3 3" stroke="#2d3748" />
              <XAxis dataKey="month" stroke="#cbd5e1" />
              <YAxis stroke="#cbd5e1" />
              <Tooltip
                formatter={(v) => formatMoney(v)}
                contentStyle={{
                  backgroundColor: "#1e293b",
                  border: "none",
                  color: "#fff",
                }}
              />
              <Legend />
              <Line
                type="monotone"
                dataKey="revenue"
                stroke="#22c55e"
                strokeWidth={3}
                name="Doanh thu"
              />
              <Line
                type="monotone"
                dataKey="expense"
                stroke="#f87171"
                strokeWidth={3}
                name="Chi phí"
              />
            </LineChart>
          </ResponsiveContainer>
        </div>

        {/* Chi tiết thống kê (sử dụng CommonDataTable) */}
        <CommonDataTable
          title="Thống kê hoạt động"
          description="Dữ liệu tổng hợp về hóa đơn, sản phẩm, khách hàng và hiệu suất hệ thống"
          columns={columns}
          data={data}
          onEdit={handleEdit}
          onDelete={handleDelete}
        />

        {/* Top sản phẩm & khách hàng */}
        <div className="row mt-4">
          <div className="col-md-6">
            <div className="card bg-dark text-white p-3 border-0 shadow-sm">
              <h6 className="text-secondary">Sản phẩm bán chạy nhất</h6>
              <h5 className="fw-bold mt-2">{summary.topProduct.name}</h5>
              <p className="mb-0 text-info">
                {summary.topProduct.quantity} sản phẩm
              </p>
            </div>
          </div>
          <div className="col-md-6">
            <div className="card bg-dark text-white p-3 border-0 shadow-sm">
              <h6 className="text-secondary">Khách hàng chi tiêu cao nhất</h6>
              <h5 className="fw-bold mt-2">{summary.topCustomer.name}</h5>
              <p className="mb-0 text-warning">
                {formatMoney(summary.topCustomer.total)}
              </p>
            </div>
          </div>
        </div>
      </div>
    </DashboardLayout>
  );
}
