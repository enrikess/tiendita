import type { PageProps } from '@inertiajs/core';
import type { LucideIcon } from 'lucide-vue-next';
import type { Config } from 'ziggy-js';

export interface Auth {
    user: User;
}

export interface BreadcrumbItem {
    title: string;
    href: string;
}

export interface NavItem {
    title: string;
    href: string;
    icon?: LucideIcon;
    isActive?: boolean;
    children?: NavItem[];
}

export interface SharedData extends PageProps {
    name: string;
    quote: { message: string; author: string };
    auth: Auth;
    ziggy: Config & { location: string };
    sidebarOpen: boolean;
}

export interface User {
    id: number;
    name: string;
    email: string;
    avatar?: string;
    email_verified_at: string | null;
    created_at: string;
    updated_at: string;
}

export type BreadcrumbItemType = BreadcrumbItem;

export interface EstadoCompra {
    id?: number;
    codigo: string;
    nombre: string;
    descripcion?: string;
    estado: boolean;
    // Campos de auditoría
    usuario_creo?: number;
    fecha_creo?: string;
    usuario_modifico?: number;
    fecha_modifico?: string;

}

export interface Proveedor {
  id?: number;
  ruc: string;
  razon_social: string;
  nombre_comercial: string;
  direccion: string;
  telefono: string;
  email: string;
  persona_contacto: string;
  estado: boolean;
}

export interface Subcategoria{
    id?: number;
    nombre: string;
    slug: string;
    categoria_id: number;
    estado: boolean;
}
