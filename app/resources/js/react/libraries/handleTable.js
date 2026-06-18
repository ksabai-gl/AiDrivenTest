import { useState } from "react";
import RenderFormTableByList from "../components/RenderFieldTableByList";

export default function useTable() {
    const [data, setData] = useState([]);
    const [links, setLinks] = useState([]);
    const [loading, setLoading] = useState(false);
    const [total, setTotal] = useState(0);
    const [colums, setColums] = useState([]);
    const addColums = (colums,render = null) => {
        setColums((prev) => {
            const existingKeys = new Set(prev.map((i) => i.key));

            const next = [...prev];

            colums.forEach((item) => {
                if (!existingKeys.has(item.key)) {
                    next.push({
                        ...item,
                        render: (data) => {
                            return render(item,data);
                        }
                    });
                }
            });

            return next;
        })
    }
    return {
        data,
        setData,
        links,
        setLinks,
        loading,
        setLoading,
        total,
        setTotal,
        colums,
        setColums,
        addColums
    }
}