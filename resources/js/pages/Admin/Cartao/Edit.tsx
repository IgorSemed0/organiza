import { Head, useForm, Link } from '@inertiajs/react';
import AdminLayout from '@/layouts/app-layout';
import { Button } from '@/components/ui/button';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import { Card, CardContent, CardHeader, CardTitle } from '@/components/ui/card';
import { Select, SelectContent, SelectItem, SelectTrigger, SelectValue } from '@/components/ui/select';

export default function Edit({ item, listas, usuarios, etiquetas }) {
    const { data, setData, put, processing, errors } = useForm({
        it_id_lista: item.it_id_lista?.toString() || '',
        it_id_usuario_criador: item.it_id_usuario_criador?.toString() || '',
        vc_titulo: item.vc_titulo || '',
        vc_descricao: item.vc_descricao || '',
        dt_data_vencimento: item.dt_data_vencimento || '',
        it_ordem: item.it_ordem?.toString() || '',
        etiquetas: item.etiquetas.map((etiqueta) => etiqueta.id.toString()) || [],
    });

    const handleSubmit = (e: React.FormEvent) => {
        e.preventDefault();
        put(route('admin.cartaos.update', item.id));
    };

    return (
        <AdminLayout title="Editar Cartão">
            <Head title="Editar Cartão" />
            <Card>
                <CardHeader>
                    <div className="flex items-center justify-between">
                        <CardTitle>Editar Cartão</CardTitle>
                        <Link href={route('admin.cartaos.index')}>
                            <Button variant="outline">Voltar</Button>
                        </Link>
                    </div>
                </CardHeader>
                <CardContent>
                    <form onSubmit={handleSubmit} className="space-y-4">
                        <div>
                            <Label htmlFor="it_id_lista">Lista</Label>
                            <Select
                                value={data.it_id_lista}
                                onValueChange={(value) => setData('it_id_lista', value)}
                            >
                                <SelectTrigger id="it_id_lista" className={errors.it_id_lista ? 'border-red-500' : ''}>
                                    <SelectValue placeholder="Selecione uma lista" />
                                </SelectTrigger>
                                <SelectContent>
                                    {listas.map((lista) => (
                                        <SelectItem key={lista.id} value={lista.id.toString()}>
                                            {lista.vc_nome}
                                        </SelectItem>
                                    ))}
                                </SelectContent>
                            </Select>
                            {errors.it_id_lista && <p className="text-sm text-red-500">{errors.it_id_lista}</p>}
                        </div>
                        <div>
                            <Label htmlFor="it_id_usuario_criador">Criador</Label>
                            <Select
                                value={data.it_id_usuario_criador}
                                onValueChange={(value) => setData('it_id_usuario_criador', value)}
                            >
                                <SelectTrigger id="it_id_usuario_criador" className={errors.it_id_usuario_criador ? 'border-red-500' : ''}>
                                    <SelectValue placeholder="Selecione um utilizador" />
                                </SelectTrigger>
                                <SelectContent>
                                    {usuarios.map((user) => (
                                        <SelectItem key={user.id} value={user.id.toString()}>
                                            {user.vc_nome}
                                        </SelectItem>
                                    ))}
                                </SelectContent>
                            </Select>
                            {errors.it_id_usuario_criador && <p className="text-sm text-red-500">{errors.it_id_usuario_criador}</p>}
                        </div>
                        <div>
                            <Label htmlFor="vc_titulo">Título</Label>
                            <Input
                                id="vc_titulo"
                                type="text"
                                value={data.vc_titulo}
                                onChange={(e) => setData('vc_titulo', e.target.value)}
                                className={errors.vc_titulo ? 'border-red-500' : ''}
                            />
                            {errors.vc_titulo && <p className="text-sm text-red-500">{errors.vc_titulo}</p>}
                        </div>
                        <div>
                            <Label htmlFor="vc_descricao">Descrição</Label>
                            <Input
                                id="vc_descricao"
                                type="text"
                                value={data.vc_descricao}
                                onChange={(e) => setData('vc_descricao', e.target.value)}
                                className={errors.vc_descricao ? 'border-red-500' : ''}
                            />
                            {errors.vc_descricao && <p className="text-sm text-red-500">{errors.vc_descricao}</p>}
                        </div>
                        <div>
                            <Label htmlFor="dt_data_vencimento">Data de Vencimento</Label>
                            <Input
                                id="dt_data_vencimento"
                                type="date"
                                value={data.dt_data_vencimento}
                                onChange={(e) => setData('dt_data_vencimento', e.target.value)}
                                className={errors.dt_data_vencimento ? 'border-red-500' : ''}
                            />
                            {errors.dt_data_vencimento && <p className="text-sm text-red-500">{errors.dt_data_vencimento}</p>}
                        </div>
                        <div>
                            <Label htmlFor="it_ordem">Ordem</Label>
                            <Input
                                id="it_ordem"
                                type="number"
                                value={data.it_ordem}
                                onChange={(e) => setData('it_ordem', e.target.value)}
                                className={errors.it_ordem ? 'border-red-500' : ''}
                            />
                            {errors.it_ordem && <p className="text-sm text-red-500">{errors.it_ordem}</p>}
                        </div>
                        <div>
                            <Label htmlFor="etiquetas">Etiquetas</Label>
                            <Select
                                multiple
                                value={data.etiquetas}
                                onValueChange={(selected) => setData('etiquetas', selected)}
                            >
                                <SelectTrigger id="etiquetas" className={errors.etiquetas ? 'border-red-500' : ''}>
                                    <SelectValue placeholder="Selecione etiquetas" />
                                </SelectTrigger>
                                <SelectContent>
                                    {etiquetas.map((etiqueta) => (
                                        <SelectItem key={etiqueta.id} value={etiqueta.id.toString()}>
                                            {etiqueta.vc_nome}
                                        </SelectItem>
                                    ))}
                                </SelectContent>
                            </Select>
                            {errors.etiquetas && <p className="text-sm text-red-500">{errors.etiquetas}</p>}
                        </div>
                        <Button type="submit" disabled={processing}>Atualizar</Button>
                    </form>
                </CardContent>
            </Card>
        </AdminLayout>
    );
}