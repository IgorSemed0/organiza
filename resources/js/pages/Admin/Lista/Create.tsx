import { Head, useForm, Link } from '@inertiajs/react';
import AdminLayout from '@/layouts/app-layout';
import { Button } from '@/components/ui/button';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import { Card, CardContent, CardHeader, CardTitle } from '@/components/ui/card';
import { Select, SelectContent, SelectItem, SelectTrigger, SelectValue } from '@/components/ui/select';

export default function Create({ quadros }) {
    const { data, setData, post, processing, errors } = useForm({
        it_id_quadro: '',
        vc_nome: '',
        it_ordem: '',
    });

    const handleSubmit = (e: React.FormEvent) => {
        e.preventDefault();
        post(route('admin.listas.store'));
    };

    return (
        <AdminLayout title="Criar Lista">
            <Head title="Criar Lista" />
            <Card>
                <CardHeader>
                    <div className="flex items-center justify-between">
                        <CardTitle>Criar Lista</CardTitle>
                        <div className="flex space-x-2">
                            <Link href={route('admin.listas.index')}>
                                <Button variant="outline">Voltar</Button>
                            </Link>
                        </div>
                    </div>
                </CardHeader>
                <CardContent>
                    <form onSubmit={handleSubmit} className="space-y-4">
                        <div>
                            <Label htmlFor="it_id_quadro">Quadro</Label>
                            <Select
                                value={data.it_id_quadro}
                                onValueChange={(value) => setData('it_id_quadro', value)}
                            >
                                <SelectTrigger id="it_id_quadro" className={errors.it_id_quadro ? 'border-red-500' : ''}>
                                    <SelectValue placeholder="Selecione um quadro" />
                                </SelectTrigger>
                                <SelectContent>
                                    {quadros.map((quadro) => (
                                        <SelectItem key={quadro.id} value={quadro.id.toString()}>
                                            {quadro.vc_nome}
                                        </SelectItem>
                                    ))}
                                </SelectContent>
                            </Select>
                            {errors.it_id_quadro && <p className="text-sm text-red-500">{errors.it_id_quadro}</p>}
                        </div>
                        <div>
                            <Label htmlFor="vc_nome">Nome</Label>
                            <Input
                                id="vc_nome"
                                type="text"
                                value={data.vc_nome}
                                onChange={(e) => setData('vc_nome', e.target.value)}
                                className={errors.vc_nome ? 'border-red-500' : ''}
                            />
                            {errors.vc_nome && <p className="text-sm text-red-500">{errors.vc_nome}</p>}
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
                        <div className="flex space-x-2">
                            <Button type="submit" disabled={processing}>Criar</Button>
                        </div>
                    </form>
                </CardContent>
            </Card>
        </AdminLayout>
    );
}