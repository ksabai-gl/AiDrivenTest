import React, { useCallback, useEffect, useMemo, useState } from "react";

export default function DashboardSummary({
  summaryData = []
}) {

  return (
    <div className="erp-summary-container d-flex flex-wrap gap-3 mt-3">
      {summaryData.map((item, i) => (
        <div key={i} className="erp-summary-card flex-grow-1 p-3">
          <div className="d-flex justify-content-between align-items-start">
            <div>
              <p className="erp-summary-title mb-1">{item.type}</p>
              <h4 className="erp-summary-value mb-2">{item.current}</h4>
            </div>
            <div
              className="erp-summary-icon rounded-3 d-flex align-items-center justify-content-center bg-primary text-white"
            >
              <i className={item.icon}/>
            </div>
          </div>
          <div className="mt-2">
            <span className={ (item.compare >= 1 ? 'text-success ' : 'text-danger ') 
              +  "erp-summary-change"}>{item.compare}%</span>{" "}
            <small className="text-secondary">{item.compare_text}</small>
          </div>
        </div>
      ))}
    </div>
  );
}
