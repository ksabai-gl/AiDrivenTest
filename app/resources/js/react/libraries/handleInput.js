import { useMemo, useState } from "react";

export function useForm() {
    const [formData, setFormData] = useState(null);
    const [formErrors, setFormErrors] = useState(null);
    const [loading, setLoading] = useState(false);
    const [isEdit, setIsEdit] = useState(false);
    const [isDestroy, setIsDestroy] = useState(false);
    const [hookRender,setHookRender] = useState([]);

    const handleChange = (e) => {
        const { name, type, value, checked } = e.target;

        setFormData(prev => ({
            ...prev,
            [name]: type === "checkbox" ? checked : value,
        }));
    };

    const handleChangeByKey = (name,value) => {
        setFormData(prev => ({
            ...prev,
            [name]: value,
        }));
    };

    const resetForm = () => setFormData(initial);
    useMemo(() => {
        if (isEdit) {
            setIsDestroy(false)
        }
        if (!isEdit) {
            setFormData(null)
        }
        setFormErrors(null)
    }, [isEdit])
    useMemo(() => {
        if (isDestroy) {
            setIsEdit(false)
        }
        if (!isDestroy) {
            setFormData(null)
        }
        setFormErrors(null)
    }, [isDestroy])
    const addHookRender = (data = []) => {
        setHookRender((prev) => {
            const existingKeys = new Set(prev.map((i) => i.key));

            const next = [...prev];

            data.forEach((item) => {
                if (!existingKeys.has(item.key)) {
                    next.push({
                        ...item
                    });
                }
            });

            return next;
        })
    }
    return {
        formData,
        setFormData,
        formErrors,
        setFormErrors,
        handleChange,
        resetForm,
        loading,
        setLoading,
        isEdit,
        setIsEdit,
        handleChangeByKey,
        setHookRender,
        hookRender,
        addHookRender
    };
}
