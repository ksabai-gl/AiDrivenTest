import React, { useEffect, useState } from "react";
import CommonDataTable from "./CommonDataTable";
export default function AutoDataTable({
  columns = [],
  fetchData,     
  filters = {},
  onEdit = null,
  onDelete = null,
  onPageChange = null
}) {
  const [rows, setRows] = useState([]);
  const [pagination, setPagination] = useState(null); 
  const [loading, setLoading] = useState(false);
  const [page, setPage] = useState(1);
  const filtersKey = JSON.stringify(filters || {});
  const load = async (nextPage = 1) => {
    if (typeof fetchData !== "function") return;

    setLoading(true);
    try {
      const params = { ...filters, page: nextPage };
      const res = await fetchData(params);
      setRows(res.data || []);
      setPagination(res || null);
      setPage(res?.current_page ?? nextPage);
      if (onPageChange) {
        onPageChange(res?.current_page ?? nextPage, res);
      }
    } catch (err) {
      console.error("AutoDataTable.fetchData error", err);
      setRows([]);
      setPagination(null);
    } finally {
      setLoading(false);
    }
  };
  useEffect(() => {
    load(1);
  }, [filtersKey]);
  const handleGoto = (link) => {
    let targetPage = null;
    if (link.page) {
      targetPage = Number(link.page);
    } else if (link.url) {
      try {
        const urlObj = new URL(link.url);
        targetPage = Number(urlObj.searchParams.get("page") || 1);
      } catch (e) {
        const m = /[?&]page=(\d+)/.exec(link.url);
        targetPage = m ? Number(m[1]) : null;
      }
    }

    if (targetPage && targetPage !== page) {
      load(targetPage);
    }
  };

  return (
    <div>
      {loading ? (
        <div className="text-center py-4">Loading...</div>
      ) : (
        <CommonDataTable
          columns={columns}
          data={rows}
          onEdit={onEdit}
          onDelete={onDelete}
        />
      )}
      {pagination && Array.isArray(pagination.links) && (
        <div className="mt-3 d-flex justify-content-between align-items-center">
          <div className="small text-muted">
            Showing {pagination.from ?? 0} - {pagination.to ?? 0} of {pagination.total ?? 0}
          </div>

          <nav>
            <ul className="pagination pagination-sm mb-0">

              {pagination.links.map((link, idx) => {
                const disabled = !link.url && !link.page;
                const active = !!link.active;
                return (
                  <li
                    key={idx}
                    className={`page-item ${active ? "active" : ""} ${disabled ? "disabled" : ""}`}
                  >
                    <button
                      className="page-link"
                      dangerouslySetInnerHTML={{ __html: link.label }}
                      onClick={() => {
                        if (!disabled) handleGoto(link);
                      }}
                    />
                  </li>
                );
              })}

            </ul>
          </nav>
        </div>
      )}
    </div>
  );
}
