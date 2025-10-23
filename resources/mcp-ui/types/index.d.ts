// Generate custom type definitions here

export interface User {
    id: string;
    name: string;
    email?: string;
}

export type WeatherWidgetData = {
    city: string;
    date: string;
    temp: {
        current: { f: number; c: number };
        high: { f: number; c: number };
        low: { f: number; c: number };
    };
    conditions: Array<{ label: string; value: string }>;
};

export type WeatherWidgetState = {
    units: 'c' | 'f';
};
