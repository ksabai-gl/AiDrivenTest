import React from "react";

export default function CustomerDetail({ data }) {
  return (
    <div className="table-responsive">
      <table className="table table-bordered table-striped">
        <tbody>

          <tr>
            <th>Name</th>
            <td>{data?.name}</td>
          </tr>

          <tr>
            <th>Contact Name</th>
            <td>{data?.contact_name}</td>
          </tr>

          <tr>
            <th>Email</th>
            <td>{data?.email}</td>
          </tr>

          <tr>
            <th>Phone</th>
            <td>{data?.phone}</td>
          </tr>

          <tr>
            <th>Address</th>
            <td style={{ whiteSpace: "pre-line" }}>{data?.address}</td>
          </tr>

          <tr>
            <th>Tax Code</th>
            <td>{data?.tax_code ?? "-"}</td>
          </tr>

          <tr>
            <th>Note</th>
            <td>{data?.note ?? "-"}</td>
          </tr>

        </tbody>
      </table>
    </div>
  );
}
