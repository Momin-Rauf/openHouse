// resources/js/Pages/Group/EvaluatorCount.js
import { Inertia } from '@inertiajs/inertia';
import React, { useState, useEffect } from 'react';

const EvaluatorCount = ({ groupId }) => {
    const [evaluatorCount, setEvaluatorCount] = useState(0);

    useEffect(() => {
        const fetchEvaluatorCount = async () => {
            const response = await Inertia.get(route('group.evaluator_count', groupId));
            setEvaluatorCount(response.evaluator_count);
        };

        fetchEvaluatorCount();
    }, [groupId]);

    return (
        <div>
            <h1>Evaluator Count: {evaluatorCount}</h1>
            {/* Render additional content as needed */}
        </div>
    );
};

export default EvaluatorCount;
